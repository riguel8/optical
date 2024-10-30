<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OphthalController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');

Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':admin'])->group(function () {
    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::get('/admin/eyewears', [AdminController::class, 'eyewears'])->name('admin.eyewears');
    Route::post('/admin/appointments/storeEyewear', [AdminController::class, 'storeEyewear'])->name('admin.storeEyewear');
    Route::post('/admin/appointments/storeAppointment', [AdminController::class, 'storeAppointment'])->name('admin.storeAppointment');
    // Route::post('/admin/appointments', [AppointmentController::class, 'edit'])->name('admin.edit');
    // Route::post('/admin/appointments', [AppointmentController::class, 'update'])->name('admin.update');

    Route::get('/admin/appointments/{id}', [AdminController::class, 'viewAppointment']);
    Route::get('/admin/appointments/edit/{id}', [AdminController::class, 'editAppointment']);
    Route::put('/admin/appointments/update/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');
    

});

Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':client'])->group(function () {
    // Client
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/appointments', [ClientController::class, 'appointments'])->name('client.appointments');
    Route::get('/client/eyewears', [ClientController::class, 'eyewears'])->name('client.eyewears');
    Route::get('/client/account_details', [ClientController::class, 'account_details'])->name('client.account_details');
    Route::put('/client/account_details', [ClientController::class, 'updateAccount'])->name('client.updateAccount');
});

Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':ophthal'])->group(function () {
    // ophthal
    Route::get('/ophthal/dashboard', [OphthalController::class, 'index'])->name('ophthal.dashboard');
    Route::get('/ophthal/patients', [OphthalController::class, 'patients'])->name('ophthal.patients');

    // Inside the existing middleware group for 'ophthal'
    Route::post('/ophthal/storePrescription', [OphthalController::class, 'storePrescription'])->name('ophthal.storePrescription');
    Route::get('/ophthal/appointments', [OphthalController::class, 'appointments'])->name('ophthal.appointments');
});

Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':staff'])->group(function () {
    // staff
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/patients', [StaffController::class, 'patients'])->name('staff.patients');
    Route::get('/staff/appointments', [StaffController::class, 'appointments'])->name('staff.appointments');
    Route::get('/staff/eyewears', [StaffController::class, 'eyewears'])->name('staff.eyewears');
    Route::post('/staff/appointments', [StaffController::class, 'store'])->name('staff.store');
    Route::post('/staff/appointments', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('/staff/appointments', [StaffController::class, 'update'])->name('staff.update');
    Route::post('/staff/eyewears', [StaffController::class, 'storeEyewear'])->name('staff.storeEyewear');
});


// Route::middleware(['auth', 'verified'])->group(function () {
//     // Admin
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');;
//     // Route::get('/admin/patients', [AdminController::class, 'index'])->name('admin.patients');;
//     // Route::get('/admin/appointments', [AdminController::class, 'index'])->name('admin.appointments');;
//     // Route::get('/admin/eyewears', [AdminController::class, 'index'])->name('admin.eyewears');;

//     // Client
//     Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
//     Route::get('/client/appointments', [ClientController::class, 'appointments'])->name('client.appointments');
//     Route::get('/client/eyewears', [ClientController::class, 'eyewears'])->name('client.eyewears');
// });



// 404 Override
Route::fallback(function () {
    return view('errors.404');
});

// URI Dashes Translation is not needed in Laravel

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


