<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DonorController;
use App\Http\Middleware\EnsureProfileIsComplete;
use App\Http\Middleware\CheckHospitalVerification;
use App\Http\Middleware\CheckDonorEligibility;
use Illuminate\Support\Facades\Route;

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




Route::get('/register/eligibility', [AuthController::class, 'showEligibility'])->name('eligibility');
Route::post('/register/eligibility', [AuthController::class, 'checkEligibility'])->name('eligibility.check');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware(['auth', EnsureProfileIsComplete::class])
    ->name('dashboard');

// DONOR ROUTES 

Route::middleware(['auth', CheckDonorEligibility::class])->group(function () {
    Route::get('/donor/dashboard', [DonorController::class, 'dashboard'])->name('donor.dashboard');
    Route::get('/donor/requests/{id}', [DonorController::class, 'showRequest'])->name('donor.requests.show');
    Route::post('/donor/requests/{id}/respond', [DonorController::class, 'respond'])->name('donor.requests.respond');
    Route::post('/donor/notifications/{id}/read', [DonorController::class, 'markNotificationRead'])->name('donor.notifications.read');
});

Route::get('/donor/not-eligible', function () {
    return view('donor.not-eligible');
})->name('donor.not-eligible')->middleware('auth');



// HOSPITAL ROUTES 

Route::middleware(['auth', CheckHospitalVerification::class])->group(function () {
    Route::get('/hospital/dashboard', function () {
        return view('hospital.dashboard');
    })->name('hospital.dashboard');

    // Blood Request Management
    Route::prefix('hospital/requests')->name('hospital.requests.')->group(function () {
        Route::get('/', [HospitalController::class, 'index'])->name('index');
        Route::get('/create', [HospitalController::class, 'create'])->name('create');
        Route::post('/', [HospitalController::class, 'store'])->name('store');
        Route::get('/{id}', [HospitalController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [HospitalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [HospitalController::class, 'update'])->name('update');
        Route::delete('/{id}', [HospitalController::class, 'destroy'])->name('destroy');

        // Responses to requests
        Route::get('/{requestId}/responses', [HospitalController::class, 'responses'])->name('responses');
    });
});

Route::get('/hospital/pending-verification', function () {
    return view('hospital.pending-verification');
})->name('hospital.pending-verification')->middleware('auth');








