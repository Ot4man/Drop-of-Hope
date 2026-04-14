<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Response as BloodResponse;
use App\Models\User;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Notifications\UrgentBloodRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class HospitalController extends Controller
{
   
    public function index()
    {
        
        $requests = BloodRequest::where('hospital_id', Auth::id())
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
        $bloodRequest = BloodRequest::create([
            'hospital_id' => Auth::id(),
            'blood_type'  => $request->blood_type,
            'quantity'    => $request->quantity,
            'urgency'     => $request->urgency,
            'location'    => $request->location,
            'status'      => 'open',
        ]);

        if (in_array($request->urgency, ['high', 'critical'])) {
            $donorsToNotify = User::where('role', 'donor')
                ->whereHas('donorProfile', function ($query) use ($request) {
                    $query->where('blood_type', $request->blood_type);
                })
                ->get();

            Notification::send($donorsToNotify, new UrgentBloodRequestNotification($bloodRequest));
        }

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request created successfully.');
    }

    
    public function show($id)
    {
        $request = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        return view('hospital.requests.show', compact('request'));
    }

    
    public function edit($id)
    {
        $request = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        return view('hospital.requests.edit', compact('request'));
    }

    
    public function update(StoreBloodRequestRequest $request, $id)
    {
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        $bloodRequest->update($request->validated());

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request updated successfully.');
    }

    
    public function destroy($id)
    {
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        $bloodRequest->delete();

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request deleted successfully.');
    }

    
    public function responses($requestId)
    {
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($requestId);

        $responses = $bloodRequest->responses()->with('donor')->latest()->get();

        return view('hospital.responses.index', compact('bloodRequest', 'responses'));
    }
}
