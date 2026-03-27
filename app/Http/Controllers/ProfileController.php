<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\ProfileUser;
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
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function update(UpdateProfileRequest $request)
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            $profile = new ProfileUser(['user_id' => Auth::id()]);
        }

        $profile->fill([
            'blood_type' => $request->blood_type,
            'phone' => $request->phone,
            'city' => $request->city,
            'available' => $request->has('available'),
            'last_donation_date' => $request->last_donation_date,
        ]);
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
