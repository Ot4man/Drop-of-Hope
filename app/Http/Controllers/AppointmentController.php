<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\HospitalProfile;
use App\Models\Notification;

class AppointmentController extends Controller
{
    public function index()
    {
        $hospitalProfile = Auth::user()->hospitalProfile;
        
        $appointments = Appointment::where(function($query) use ($hospitalProfile) {
                $query->whereHas('response.bloodRequest', function($q) use ($hospitalProfile) {
                    $q->where('hospital_id', $hospitalProfile->id);
                })->orWhere('hospital_id', $hospitalProfile->id);
            })
            ->with(['response.donorProfile.user', 'response.bloodRequest', 'donorProfile.user'])
            ->latest()
            ->get();

        return view('hospital.appointments.index', compact('appointments'));
    }

    public function edit($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $appointment = Appointment::whereHas('response.bloodRequest', function($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })
            ->with(['response.donorProfile.user', 'response.bloodRequest'])
            ->findOrFail($id);

        return view('hospital.appointments.edit', compact('appointment'));
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $appointment = Appointment::whereHas('response.bloodRequest', function($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })->findOrFail($id);

        $appointment->update([
            'scheduled_at' => $request->scheduled_at,
            'notes' => $request->notes,
            'status' => 'scheduled',
        ]);

        return redirect()->route('hospital.appointments.index')
            ->with('success', 'Appointment confirmed for ' . \Carbon\Carbon::parse($request->scheduled_at)->format('M d, Y \a\t H:i') . '.');
    }

    public function donorIndex()
    {
        $donorProfile = Auth::user()->donorProfile;
        
        $appointments = Appointment::where(function($query) use ($donorProfile) {
                $query->whereHas('response', function($q) use ($donorProfile) {
                    $q->where('donor_id', $donorProfile->id);
                })->orWhere('donor_id', $donorProfile->id);
            })
            ->with(['response.bloodRequest.hospitalProfile.user', 'response.bloodRequest', 'hospitalProfile.user'])
            ->latest()
            ->get();

        return view('donor.appointments.index', compact('appointments'));
    }

    public function create(Request $request)
    {
        $hospitalId = $request->query('hospital_id');
        $hospital = \App\Models\HospitalProfile::with('user')->findOrFail($hospitalId);

        return view('donor.appointments.create', compact('hospital'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospital_profiles,id',
            'scheduled_at' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $donorProfile = Auth::user()->donorProfile;

        if (!$donorProfile->evaluateEligibility()) {
            return redirect()->route('donor.dashboard')->with('error', 'You are not eligible to donate yet (56-day rule).');
        }

        $appointment = Appointment::create([
            'donor_id' => $donorProfile->id,
            'hospital_id' => $request->hospital_id,
            'scheduled_at' => $request->scheduled_at,
            'notes' => $request->notes,
            'status' => 'scheduled',
        ]);

        $hospital = HospitalProfile::find($request->hospital_id);
        Notification::create([
            'user_id' => $hospital->user_id,
            'message' => "New proactive donation appointment scheduled by " . Auth::user()->first_name . " for " . \Carbon\Carbon::parse($request->scheduled_at)->format('M d, Y \a\t H:i') . ".",
            'link' => route('hospital.appointments.index'),
            'type' => 'new_appointment',
        ]);

        return redirect()->route('donor.appointments.index')
            ->with('success', 'Appointment scheduled successfully! The hospital has been notified.');
    }

    public function complete($id)
    {
        $hospitalId = Auth::user()->hospitalProfile->id;
        $appointment = Appointment::where(function($query) use ($hospitalId) {
                $query->whereHas('response.bloodRequest', function($q) use ($hospitalId) {
                    $q->where('hospital_id', $hospitalId);
                })->orWhere('hospital_id', $hospitalId);
            })->findOrFail($id);

        $appointment->update(['status' => 'completed']);

        $donorProfile = $appointment->response ? $appointment->response->donorProfile : $appointment->donorProfile;
        $donorProfile->update([
            'last_donation_date' => now(),
            'available' => false,
        ]);

        Notification::create([
            'user_id' => $donorProfile->user_id,
            'message' => "Thank you for your life-saving donation at " . Auth::user()->hospitalProfile->hospital_name . " You have earned our gratitude and respect.",
            'type' => 'donation_completed',
        ]);

        return redirect()->route('hospital.appointments.index')->with('success', 'Donation validated. Donor profile updated.');
    }
}

