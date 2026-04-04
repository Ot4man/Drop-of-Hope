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
            'zip_code' => $request->zip_code,
            'donor_id' => $request->donor_id,
            'role' => 'donor',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Redirect donor directly to eligibility check after basic info input!
        return redirect()->route('eligibility')->with('success', 'Registration successful! Let\'s check your eligibility.');
    }

    public function showHospitalRegister()
    {
        return view('auth.register-hospital');
    }

    public function registerHospital(HospitalRegisterRequest $request)
    {
        // Creating parent User wrapper for hospital admin
        $user = User::create([
            'first_name' => 'Hospital',
            'last_name' => 'Admin',
            'email' => $request->email,
            'username' => $request->username,
            'dob' => now()->subYears(20), // dummy for schema compliance
            'zip_code' => 'HOSPITAL', // dummy for schema compliance
            'role' => 'hospital',
            'password' => Hash::make($request->password),
        ]);

        // Creating the specific hospital profile securely
        $user->hospitalProfile()->create([
            'hospital_name' => $request->hospital_name,
            'license_number' => $request->license_number,
            'contact_phone' => $request->contact_phone,
            'city' => $request->city,
            'address' => $request->address,
            'is_verified' => true,
        ]);

        Auth::login($user);

        // This will naturally be caught by the middleware and shown pending-verification!
        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Attempt to login using either email or username
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
