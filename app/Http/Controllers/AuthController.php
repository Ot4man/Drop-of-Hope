<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\HospitalRegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showEligibility()
    {
        return view('auth.eligibility');
    }

    public function showRoleSelection()
    {
        return view('auth.role-selection');
    }

    public function showDonorRegister()
    {
        return view('auth.register');
    }

    public function registerDonor(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'dob' => $request->date_of_birth,
            'role' => 'donor',
            'password' => Hash::make($request->password),
        ]);
        $user->donorProfile()->create([
            'blood_type' => $request->blood_type ?? 'Unknown',
            'phone' => $request->phone ?? '',
            'city' => $request->city ?? 'Unknown',
            'available' => true,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to Drop of Hope.');
    }

    public function checkEligibility(Request $request)
    {
        return redirect()->route('register.donor');
    }

    public function showHospitalRegister()
    {
        return view('auth.register-hospital');
    }

    public function registerHospital(HospitalRegisterRequest $request)
    {
        $user = User::create([
            'first_name' => 'Hospital',
            'last_name' => 'Admin',
            'email' => $request->email,
            'username' => $request->username,
            'dob' => now()->subYears(20),
            'role' => 'hospital',
            'password' => Hash::make($request->password),
        ]);

        $user->hospitalProfile()->create([
            'hospital_name' => $request->hospital_name,
            'license_number' => $request->license_number,
            'contact_phone' => $request->contact_phone,
            'city' => $request->city,
            'address' => $request->address,
            'is_verified' => false, 
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
