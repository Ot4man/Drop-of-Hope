<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        
        $notifications = $user->notifications()->latest()->limit(5)->get();

        $requests = BloodRequest::where('status', 'open')
            ->orderByRaw("CASE 
                WHEN urgency = 'critical' THEN 1 
                WHEN urgency = 'high' THEN 2 
                WHEN urgency = 'medium' THEN 3 
                ELSE 4 END ASC")
            ->latest()
            ->paginate(10);

        return view('donor.dashboard', compact('requests', 'notifications'));
    }

    public function showRequest($id)
    {
        $bloodRequest = BloodRequest::with('hospital.hospitalProfile')->findOrFail($id);
        
        $alreadyResponded = Response::where('blood_request_id', $id)
            ->where('donor_id', Auth::id())
            ->exists();

        return view('donor.requests.show', compact('bloodRequest', 'alreadyResponded'));
    }

    public function respond(Request $request, $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);

        $exists = Response::where('blood_request_id', $id)
            ->where('donor_id', Auth::id())
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You have already responded to this request.');
        }

        Response::create([
            'blood_request_id' => $id,
            'donor_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->route('donor.dashboard')->with('success', 'Thank you! The hospital has been notified of your response.');
    }

    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }
}
