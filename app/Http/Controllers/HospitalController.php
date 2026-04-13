<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Response as BloodResponse;
use App\Http\Requests\StoreBloodRequestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of blood requests created by the authenticated hospital.
     */
    public function index()
    {
        // Get all requests belonging to the current hospital
        $requests = BloodRequest::where('hospital_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('hospital.requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new blood request.
     */
    public function create()
    {
        return view('hospital.requests.create');
    }

    /**
     * Store a newly created blood request in storage.
     */
    public function store(StoreBloodRequestRequest $request)
    {
        // Validation is automatically handled by StoreBloodRequestRequest

        // Create the request linked to the logged-in hospital
        BloodRequest::create([
            'hospital_id' => Auth::id(),
            'blood_type'  => $request->blood_type,
            'quantity'    => $request->quantity,
            'urgency'     => $request->urgency,
            'location'    => $request->location,
            'status'      => 'open', // Default status
        ]);

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request created successfully.');
    }

    /**
     * Display the specified blood request.
     */
    public function show($id)
    {
        // Ensure the request belongs to the authenticated hospital
        $request = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        return view('hospital.requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified blood request.
     */
    public function edit($id)
    {
        // Ensure the request belongs to the authenticated hospital
        $request = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        return view('hospital.requests.edit', compact('request'));
    }

    /**
     * Update the specified blood request in storage.
     */
    public function update(StoreBloodRequestRequest $request, $id)
    {
        // Ensure the request belongs to the authenticated hospital
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        // Validation is automatically handled by StoreBloodRequestRequest
        $bloodRequest->update($request->validated());

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request updated successfully.');
    }

    /**
     * Remove the specified blood request from storage.
     */
    public function destroy($id)
    {
        // Ensure the request belongs to the authenticated hospital
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($id);

        $bloodRequest->delete();

        return redirect()->route('hospital.requests.index')
            ->with('success', 'Blood request deleted successfully.');
    }

    /**
     * Show all responses related to a specific blood request.
     */
    public function responses($requestId)
    {
        // Ensure the blood request exists and belongs to this hospital
        $bloodRequest = BloodRequest::where('hospital_id', Auth::id())->findOrFail($requestId);

        // Load responses with associated donor information (User relationship)
        $responses = $bloodRequest->responses()->with('donor')->latest()->get();

        return view('hospital.responses.index', compact('bloodRequest', 'responses'));
    }
}
