<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BloodRequest;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\HospitalProfile;
use \App\Models\Notification;
class DonorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->donorProfile;
        
        $totalResponses = Response::where('donor_id', $profile->id)->count();
        $totalDonations = Appointment::whereHas('response', function($query) use ($profile) {
                $query->where('donor_id', $profile->id);
            })->where('status', 'completed')->count();
            
        $lastDonation = $profile->last_donation_date;

        $upcomingAppointment = Appointment::whereHas('response', function($query) use ($profile) {
                $query->where('donor_id', $profile->id);
            })
            ->whereIn('status', ['pending', 'scheduled', 'confirmed'])
            ->where('scheduled_at', '>=', now())
            ->with('response.bloodRequest.hospitalProfile')
            ->orderBy('scheduled_at', 'asc')
            ->first();

        if ($profile && $profile->available) {
            $requests = BloodRequest::where('blood_type', $profile->blood_type)
                ->where('status', 'open')
                ->whereHas('hospitalProfile', function($query) use ($profile) {
                    $query->where('city', $profile->city);
                })
                ->limit(5)
                ->get();
        } else {
            $requests = collect();
        }

        return view('donor.dashboard', compact('requests', 'profile', 'upcomingAppointment', 'totalDonations', 'totalResponses', 'lastDonation'));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);
            
        return view('notifications.index', compact('notifications'));
    }

    public function showRequest($id)
    {
        $bloodRequest = BloodRequest::with('hospitalProfile.user')->findOrFail($id);
        $donorProfileId = Auth::user()->donorProfile->id;
        
        $alreadyResponded = Response::where('blood_request_id', $id)
            ->where('donor_id', $donorProfileId)
            ->exists();

        return view('donor.requests.show', compact('bloodRequest', 'alreadyResponded'));
    }

    public function respond(Request $request, $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $donorProfileId = Auth::user()->donorProfile->id;

        $exists = Response::where('blood_request_id', $id)
            ->where('donor_id', $donorProfileId)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You have already responded to this request.');
        }

        Response::create([
            'blood_request_id' => $id,
            'donor_id' => $donorProfileId,
            'status' => 'pending',
        ]);

        return redirect()->route('donor.dashboard')->with('success', 'Thank you, the hospital has been notified of your response.');
    }

    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function hospitals()
    {
        $hospitals = HospitalProfile::where('is_verified', true)
            ->with('user')
            ->paginate(12);

        return view('donor.hospitals', compact('hospitals'));
    }

    public function showHospital($id)
    {
        $hospital = HospitalProfile::with('user')->findOrFail($id);

        return view('donor.hospital-details', compact('hospital'));
    }

    public function responses()
    {
        $profile = Auth::user()->donorProfile;
        
        $pendingResponses = Response::where('donor_id', $profile->id)->where('status', 'pending')->with('bloodRequest.hospitalProfile')->latest()->get();
        $acceptedResponses = Response::where('donor_id', $profile->id)->where('status', 'accepted')->with('bloodRequest.hospitalProfile')->latest()->get();
        $rejectedResponses = Response::where('donor_id', $profile->id)->where('status', 'rejected')->with('bloodRequest.hospitalProfile')->latest()->get();

        return view('donor.responses', compact('pendingResponses', 'acceptedResponses', 'rejectedResponses'));
    }
}

