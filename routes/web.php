<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRoleSelection'])->name('register');
    
    Route::get('/register/donor', [AuthController::class, 'showDonorRegister'])->name('register.donor');
    Route::post('/register/donor', [AuthController::class, 'registerDonor'])->name('register.donor.post');
    
    Route::get('/register/hospital', [AuthController::class, 'showHospitalRegister'])->name('register.hospital');
    Route::post('/register/hospital', [AuthController::class, 'registerHospital'])->name('register.hospital.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Middleware\EnsureProfileIsComplete;

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', EnsureProfileIsComplete::class])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/register/eligibility', [AuthController::class, 'showEligibility'])->name('eligibility');
    Route::post('/register/eligibility', [AuthController::class, 'checkEligibility'])->name('eligibility.check');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// DONOR ROUTES 

Route::middleware(['auth', \App\Http\Middleware\CheckDonorEligibility::class])->group(function () {
    Route::get('/donor/dashboard', function () {
        return "Welcome eligible donor You can now view and accept blood requests.";
    })->name('donor.dashboard');
    
});

Route::get('/donor/not-eligible', function () {
    return view('donor.not-eligible');
})->name('donor.not-eligible')->middleware('auth');



// HOSPITAL ROUTES 

Route::middleware(['auth', \App\Http\Middleware\CheckHospitalVerification::class])->group(function () {
    Route::get('/hospital/dashboard', function () {
        return "Welcome verified hospital You can now create urgent blood requests.";
    })->name('hospital.dashboard');
    
});

Route::get('/hospital/pending-verification', function () {
    return view('hospital.pending-verification');
})->name('hospital.pending-verification')->middleware('auth');








