<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OphthalController;
// use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Staff\EyewearController;
use App\Http\Controllers\Staff\AppointmentController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');

// Admin Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':admin'])->group(function () {
 
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::get('/admin/eyewears', [AdminController::class, 'eyewears'])->name('admin.eyewears');
    Route::post('/admin/appointments/storeEyewear', [AdminController::class, 'storeEyewear'])->name('admin.storeEyewear');
    Route::post('/admin/appointments/storeAppointment', [AdminController::class, 'storeAppointment'])->name('admin.storeAppointment');
    
    Route::get('/admin/appointments/{id}', [AdminController::class, 'viewAppointment']);
    Route::get('/admin/appointments/edit/{id}', [AdminController::class, 'editAppointment']);
    Route::put('/admin/appointments/update/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');
});
 // Client Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':client'])->group(function () {
   
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/appointments', [ClientController::class, 'appointments'])->name('client.appointments');
    Route::get('/client/eyewears', [ClientController::class, 'eyewears'])->name('client.eyewears');
    Route::get('/client/account_details', [ClientController::class, 'account_details'])->name('client.account_details');
    Route::put('/client/account_details', [ClientController::class, 'updateAccount'])->name('client.updateAccount');
});

// Ophthal Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':ophthal'])->group(function () {

    Route::get('/ophthal/dashboard', [OphthalController::class, 'index'])->name('ophthal.dashboard');
    Route::get('/ophthal/patients', [OphthalController::class, 'patients'])->name('ophthal.patients');

    // Inside the existing middleware group for 'ophthal'
    Route::post('/ophthal/storePrescription', [OphthalController::class, 'storePrescription'])->name('ophthal.storePrescription');
    Route::get('/ophthal/appointments', [OphthalController::class, 'appointments'])->name('ophthal.appointments');
});


// Staff Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':staff'])->group(function () {
   
    Route::get('/staff/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/dashboard/get_appointments', [DashboardController::class, 'getAppointments']);
    Route::get('/staff/dashboard/get_appointment_details', [DashboardController::class, 'getAppointmentDetails']);

    Route::get('/staff/patients', [StaffController::class, 'patients'])->name('staff.patients');


    // Appointment CRUD
    Route::get('/staff/appointments', [AppointmentController::class, 'index'])->name('staff.appointments');
    Route::post('/staff/appointments', [AppointmentController::class, 'store'])->name('staff.appointments.store');
    Route::get('/staff/appointments/{id}', [AppointmentController::class, 'view']);
    Route::get('/staff/appointments/edit/{id}', [AppointmentController::class, 'edit']);
    Route::put('/staff/appointments/update/{id}', [AppointmentController::class, 'update'])->name('staff.appointments.update');
    Route::delete('/staff/appointments/{id}', [AppointmentController::class, 'delete'])->name('staff.appointments.delete');

    // Eyewear CRUD
    Route::get('/staff/eyewears', [EyewearController::class, 'index'])->name('staff.eyewears');
    Route::post('/staff/eyewears', [EyewearController::class, 'store'])->name('staff.eyewears.store');
    Route::get('/staff/eyewears/view-details/{id}', [EyewearController::class, 'view'])->name('staff.view-details');
    Route::get('/staff/eyewears/edit/{id}', [EyewearController::class, 'edit']);
    Route::put('/staff/eyewears/update/{id}', [EyewearController::class, 'update'])->name('staff.eyewears.update');
    Route::delete('/staff/eyewears/{id}', [EyewearController::class, 'delete'])->name('staff.eyewears.delete');
});

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


