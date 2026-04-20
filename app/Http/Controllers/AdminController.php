<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HospitalProfile;
use Illuminate\Http\Request;
use App\Models\BloodRequest;
class AdminController extends Controller
{
    public function dashboard()
    {
        $hospitals = User::where('role', 'hospital')->with('hospitalProfile')->get();
        $donors = User::where('role', 'donor')->get();
        
        $stats = [
            'donors' => $donors->count(),
            'hospitals' => $hospitals->count(),
            'requests' => BloodRequest::count(),
        ];

        return view('admin.dashboard', compact('hospitals', 'donors', 'stats'));
    }

    public function verifyHospital($id)
    {
        $hospital = User::where('role', 'hospital')->findOrFail($id);
        
        if ($hospital->hospitalProfile) {
            $hospital->hospitalProfile->update(['is_verified' => true]);
        }

        return back()->with('success', 'Hospital verified successfully.');
    }

    public function hospitals()
    {
        $hospitals = User::where('role', 'hospital')->with('hospitalProfile')->get();
        return view('admin.hospitals', compact('hospitals'));
    }

    public function donors()
    {
        $donors = User::where('role', 'donor')->get();
        return view('admin.donors', compact('donors'));
    }
}
