<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'donor') {
            return redirect()->route('donor.dashboard');
        }

        if ($user->role == 'hospital') {
            return redirect()->route('hospital.dashboard');
        }

        return redirect('/'); // fallback
    }
}
