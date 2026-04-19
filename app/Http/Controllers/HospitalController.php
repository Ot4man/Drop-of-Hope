<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BloodRequest;
use App\Models\Response as BloodResponse;
use App\Models\DonorProfile;
use App\Models\User;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Notifications\UrgentBloodRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Notification;
class HospitalController extends Controller
{

    public function dashboard()
    {
        $hospitalProfile = Auth::user()->hospitalProfile;
        $hospitalId = $hospitalProfile->id;

        $activeRequests = BloodRequest::where('hospital_id', $hospitalId)
            ->where('status', 'open')
            ->latest()
            ->get();

        $recentResponses = BloodResponse::whereHas('bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })
            ->where('status', 'pending')
            ->with(['donorProfile', 'bloodRequest'])
            ->latest()
            ->limit(5)
            ->get();

        $appointments = Appointment::whereHas('response.bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })
            ->where('scheduled_at', '>=', now())
            ->with('response.donorProfile.user')
            ->orderBy('scheduled_at', 'asc')
            ->get();

        $totalRequests = BloodRequest::where('hospital_id', $hospitalId)->count();
        $totalDonations = Appointment::whereHas('response.bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })->where('status', 'completed')->count();

        return view('hospital.dashboard', compact('activeRequests', 'recentResponses', 'appointments', 'totalRequests', 'totalDonations'));
    }

    public function index()
    {
        $hospitalId = Auth::user()->hospitalProfile->id;

        $requests = BloodRequest::where('hospital_id', $hospitalId)
            ->latest()
            ->paginate(10);

        return view('hospital.requests.index', compact('requests'));
    }


    public function create()
    {
        return view('hospital.requests.create');
    }


    public function store(StoreBloodRequestRequest $request)
    {
        $hospitalProfile = Auth::user()->hospitalProfile;

        $bloodRequest = BloodRequest::create([
            'hospital_id' => $hospitalProfile->id,
            'blood_type' => $request->blood_type,
            'quantity' => $request->quantity,
            'urgency' => $request->urgency,
            'status' => 'open',
        ]);

        $donorsToNotify = DonorProfile::where('blood_type', $request->blood_type)
            ->where('city', $hospitalProfile->city)
            ->with('user')
            ->get();

        foreach ($donorsToNotify as $donor) {
            Notification::create([
                'user_id' => $donor->user_id,
                'message' => "Emergency: {$request->blood_type} blood needed at {$hospitalProfile->hospital_name}!",
                'link' => route('donor.requests.show', $bloodRequest->id),
                'type' => 'urgent_request',
            ]);
        }

        return redirect()->route('hospital.dashboard')
            ->with('success', 'Blood request created successfully');
    }


    public function show($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $request = BloodRequest::where('hospital_id', $hospitalId)->findOrFail($id);

        return view('hospital.requests.show', compact('request'));
    }


    public function edit($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $request = BloodRequest::where('hospital_id', $hospitalId)->findOrFail($id);

        return view('hospital.requests.edit', compact('request'));
    }


    public function update(StoreBloodRequestRequest $request, $id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $bloodRequest = BloodRequest::where('hospital_id', $hospitalId)->findOrFail($id);

        $bloodRequest->update($request->validated());

        return redirect()->route('hospital.dashboard')
            ->with('success', 'Blood request updated successfully');
    }


    public function destroy($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $bloodRequest = BloodRequest::where('hospital_id', $hospitalId)->findOrFail($id);

        $bloodRequest->delete();

        return redirect()->route('hospital.dashboard')
            ->with('success', 'Blood request deleted successfully.');
    }


    public function closeRequest($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $request = BloodRequest::where('hospital_id', $hospitalId)->findOrFail($id);
        $request->update(['status' => 'closed']);

        return back()->with('success', 'Blood request closed.');
    }

    public function acceptResponse($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $response = BloodResponse::whereHas('bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })->findOrFail($id);

        $response->update(['status' => 'accepted']);

        Appointment::updateOrCreate(
            ['response_id' => $response->id],
            [
                'scheduled_at' => now()->addDay()->setHour(10)->setMinute(0),
                'status' => 'scheduled'
            ]
        );

        Notification::create([
            'user_id' => $response->donorProfile->user_id,
            'message' => "Your donation response has been accepted. View your appointment details here.",
            'link' => route('donor.appointments.index'),
            'type' => 'response_accepted',
        ]);

        return redirect()->route('hospital.dashboard')->with('success', 'Response accepted. The donor has been notified.');
    }

    public function rejectResponse($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $response = BloodResponse::whereHas('bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })->findOrFail($id);

        $response->update(['status' => 'rejected']);

        return back()->with('success', 'Response rejected.');
    }

    public function allResponses()
    {
        $hospitalId = Auth::user()->hospitalProfile->id;

        $responses = BloodResponse::whereHas('bloodRequest', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })
            ->with(['donorProfile.user', 'bloodRequest'])
            ->latest()
            ->paginate(15);

        return view('hospital.responses.index', compact('responses'));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('hospital.notifications.index', compact('notifications'));
    }
}

