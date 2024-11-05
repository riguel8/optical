<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OphthalController;

use App\Http\Controllers\Admin\EyewearController as AdminEyewearController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Staff\EyewearController as StaffEyewearController;
use App\Http\Controllers\Staff\AppointmentController as StaffAppointmentController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');

// Admin Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':admin'])->group(function () {
    
    // DASHBOARD MODULE
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/get_appointments', [AdminDashboardController::class, 'getAppointments']);
    Route::get('/admin/dashboard/get_appointment_details', [AdminDashboardController::class, 'getAppointmentDetails']);

    Route::get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::post('/admin/appointments/storeEyewear', [AdminController::class, 'storeEyewear'])->name('admin.storeEyewear');
    Route::post('/admin/appointments/storeAppointment', [AdminController::class, 'storeAppointment'])->name('admin.storeAppointment');
    
    Route::get('/admin/appointments/{id}', [AdminController::class, 'viewAppointment']);
    Route::get('/admin/appointments/edit/{id}', [AdminController::class, 'editAppointment']);
    Route::put('/admin/appointments/update/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');

    // EYEWEAR CRUD
    Route::get('/admin/eyewears', [AdminEyewearController::class, 'index'])->name('admin.eyewears');
    Route::post('/admin/eyewears', [AdminEyewearController::class, 'store'])->name('admin.eyewears.store');
    Route::get('/admin/eyewears/view-details/{id}', [AdminEyewearController::class, 'view'])->name('admin.view-details');
    Route::get('/admin/eyewears/edit/{id}', [AdminEyewearController::class, 'edit']);
    Route::put('/admin/eyewears/update/{id}', [AdminEyewearController::class, 'update'])->name('admin.eyewears.update');
    Route::delete('/admin/eyewears/{id}', [AdminEyewearController::class, 'delete'])->name('admin.eyewears.delete');
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
   
    // DASHBOARD MODULE
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/dashboard/get_appointments', [StaffDashboardController::class, 'getAppointments']);
    Route::get('/staff/dashboard/get_appointment_details', [StaffDashboardController::class, 'getAppointmentDetails']);

    // Patient Module
    Route::get('/staff/patients', [StaffController::class, 'patients'])->name('staff.patients');


    // Appointment CRUD
    Route::get('/staff/appointments', [StaffAppointmentController::class, 'index'])->name('staff.appointments');
    Route::post('/staff/appointments', [StaffAppointmentController::class, 'store'])->name('staff.appointments.store');
    Route::get('/staff/appointments/{id}', [StaffAppointmentController::class, 'view']);
    Route::get('/staff/appointments/edit/{id}', [StaffAppointmentController::class, 'edit']);
    Route::put('/staff/appointments/update/{id}', [StaffAppointmentController::class, 'update'])->name('staff.appointments.update');
    Route::delete('/staff/appointments/{id}', [StaffAppointmentController::class, 'delete'])->name('staff.appointments.delete');

    // Eyewear CRUD
    Route::get('/staff/eyewears', [StaffEyewearController::class, 'index'])->name('staff.eyewears');
    Route::post('/staff/eyewears', [StaffEyewearController::class, 'store'])->name('staff.eyewears.store');
    Route::get('/staff/eyewears/view-details/{id}', [StaffEyewearController::class, 'view'])->name('staff.view-details');
    Route::get('/staff/eyewears/edit/{id}', [StaffEyewearController::class, 'edit']);
    Route::put('/staff/eyewears/update/{id}', [StaffEyewearController::class, 'update'])->name('staff.eyewears.update');
    Route::delete('/staff/eyewears/{id}', [StaffEyewearController::class, 'delete'])->name('staff.eyewears.delete');
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


