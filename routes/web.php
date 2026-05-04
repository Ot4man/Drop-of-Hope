<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureProfileIsComplete;
use App\Http\Middleware\CheckHospitalVerification;
use App\Http\Middleware\CheckDonorEligibility;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
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

    Route::get('/register/eligibility', [AuthController::class, 'showEligibility'])->name('eligibility');
    Route::post('/register/eligibility', [AuthController::class, 'checkEligibility'])->name('eligibility.check');


    /*
    |--------------------------------------------------------------------------
    | Authenticated Shared Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/dashboard', [RedirectController::class, 'index'])
        ->middleware(EnsureProfileIsComplete::class)
        ->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Donor Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckDonorEligibility::class])
    ->prefix('donor')
    ->name('donor.')
    ->group(function () {
        Route::get('/dashboard', [DonorController::class, 'dashboard'])->name('dashboard');
        Route::get('/responses', [DonorController::class, 'responses'])->name('responses.index');
        Route::get('/appointments', [AppointmentController::class, 'donorIndex'])->name('appointments.index');
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

        Route::get('/requests/{id}', [DonorController::class, 'showRequest'])->name('requests.show');
        Route::post('/requests/{id}/respond', [DonorController::class, 'respond'])->name('requests.respond');

        Route::get('/hospitals', [DonorController::class, 'hospitals'])->name('hospitals');
        Route::get('/hospitals/{id}', [DonorController::class, 'showHospital'])->name('hospitals.show');

        Route::get('/notifications', [DonorController::class, 'notifications'])->name('notifications');
        Route::post('/notifications/{id}/read', [DonorController::class, 'markNotificationRead'])->name('notifications.read');
    });

Route::get('/donor/not-eligible', function () {
    return view('donor.not-eligible');
})->name('donor.not-eligible')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Hospital Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckHospitalVerification::class])
    ->prefix('hospital')
    ->name('hospital.')
    ->group(function () {
        Route::get('/dashboard', [HospitalController::class, 'dashboard'])->name('dashboard');
        Route::get('/notifications', [HospitalController::class, 'notifications'])->name('notifications');

        // Blood Requests Management
        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [HospitalController::class, 'index'])->name('index');
            Route::get('/create', [HospitalController::class, 'create'])->name('create');
            Route::post('/', [HospitalController::class, 'store'])->name('store');
            Route::get('/responses', [HospitalController::class, 'allResponses'])->name('all_responses');

            Route::get('/{id}', [HospitalController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [HospitalController::class, 'edit'])->name('edit');
            Route::put('/{id}', [HospitalController::class, 'update'])->name('update');
            Route::delete('/{id}', [HospitalController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/close', [HospitalController::class, 'closeRequest'])->name('close');

            Route::get('/{requestId}/responses', [HospitalController::class, 'responses'])->name('responses');
            Route::post('/responses/{id}/accept', [HospitalController::class, 'acceptResponse'])->name('accept');
            Route::post('/responses/{id}/reject', [HospitalController::class, 'rejectResponse'])->name('reject');
        });

        // Appointments Management
        Route::prefix('appointments')->name('appointments.')->group(function () {
            Route::get('/', [AppointmentController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [AppointmentController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AppointmentController::class, 'update'])->name('update');
            Route::post('/{id}/complete', [AppointmentController::class, 'complete'])->name('complete');
        });
    });

Route::get('/hospital/pending-verification', function () {
    return view('hospital.pending-verification');
})->name('hospital.pending-verification')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/hospitals', [AdminController::class, 'hospitals'])->name('hospitals');
        Route::get('/donors', [AdminController::class, 'donors'])->name('donors');
        Route::post('/hospitals/{id}/verify', [AdminController::class, 'verifyHospital'])->name('hospitals.verify');
    });
