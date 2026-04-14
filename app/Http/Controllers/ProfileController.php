<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();

        if ($user->role === 'hospital') {
            return view('profile.hospital-edit', compact('user'));
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        if ($user->role === 'hospital') {
            $user->hospitalProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'contact_phone' => $request->contact_phone,
                    'city' => $request->city,
                    'address' => $request->address,
                ]
            );

            return redirect()->back()->with('success', 'Hospital profile updated successfully!');
        }

        // Donor Logic
        $profile = $user->donorProfile;

        if (!$profile) {
            $profile = $user->donorProfile()->create([
                'blood_type' => $request->blood_type,
                'phone' => $request->phone,
                'city' => $request->city,
                'available' => $request->has('available'),
                'last_donation_date' => $request->last_donation_date,
            ]);
        } else {
            $profile->update([
                'blood_type' => $request->blood_type,
                'phone' => $request->phone,
                'city' => $request->city,
                'available' => $request->has('available'),
                'last_donation_date' => $request->last_donation_date,
            ]);
        }

        $profile->evaluateEligibility();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
