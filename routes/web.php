<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OphthalController;
// ADMIN CONTROLLER
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\EyewearController as AdminEyewearController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\SystemController as AdminSystemController;
use App\Http\Controllers\Admin\ChatbotController as AdminChatbotController;
// STAFF CONTROLLER
use App\Http\Controllers\Staff\EyewearController as StaffEyewearController;
use App\Http\Controllers\Staff\AppointmentController as StaffAppointmentController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\PatientController as StaffPatientController;
use App\Http\Controllers\Staff\ChatbotController as StaffChatbotController;
// CLIENT
use App\Http\Controllers\Client\EyewearController as ClientEyewearController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\AccountController as ClientAccountController;
// OPHTHAL
use App\Http\Controllers\Ophthal\DashboardController as OphthalDashboardController;
use App\Http\Controllers\Ophthal\AppointmentController as OphthalAppointmentController;
use App\Http\Controllers\Ophthal\PatientController as OphthalPatientController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');

// Admin Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':admin'])->group(function () {
    
    // Dashboard Module
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/admin/dashboard/get_appointments', [AdminDashboardController::class, 'getAppointments']);
    Route::get('/admin/dashboard/get_appointment_details', [AdminDashboardController::class, 'getAppointmentDetails']);

    // Dashboard Module
    // Route::post('/admin/appointments/storeEyewear', [AdminController::class, 'storeEyewear'])->name('admin.storeEyewear');
    // Route::post('/admin/appointments/storeAppointment', [AdminController::class, 'storeAppointment'])->name('admin.storeAppointment');

    // Patient (View & Edit)
    Route::get('/admin/patients', [AdminPatientController::class, 'index'])->name('admin.patients');
    Route::get('/admin/patients/{id}', [AdminPatientController::class, 'view']);
    Route::get('/admin/patients/edit/{id}', [AdminPatientController::class, 'edit']);
    Route::put('/admin/patients/update/{id}', [AdminPatientController::class, 'update'])->name('admin.patients.update');
    
    // Appointment CRUD
    Route::get('/admin/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments');
    Route::post('/admin/appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
    Route::get('/admin/appointments/{id}', [AdminAppointmentController::class, 'view']);
    Route::get('/admin/appointments/edit/{id}', [AdminAppointmentController::class, 'edit']);
    Route::put('/admin/appointments/update/{id}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/admin/appointments/{id}', [AdminAppointmentController::class, 'delete'])->name('admin.appointments.delete');
    // Calendar Time Slot Availability
    Route::get('/appointments/check-availability', [AdminAppointmentController::class, 'checkAvailability']);


    // Route::get('/admin/appointments/{id}', [AdminAppointmentController::class, 'view']);
    // Route::get('/admin/appointments/edit/{id}', [AdminController::class, 'editAppointment']);
    // Route::put('/admin/appointments/update/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');

    // Eyewear CRUD
    Route::get('/admin/eyewears', [AdminEyewearController::class, 'index'])->name('admin.eyewears');
    Route::post('/admin/eyewears', [AdminEyewearController::class, 'store'])->name('admin.eyewears.store');
    Route::get('/admin/eyewears/view-details/{id}', [AdminEyewearController::class, 'view'])->name('admin.view-details');
    Route::get('/admin/eyewears/edit/{id}', [AdminEyewearController::class, 'edit']);
    Route::put('/admin/eyewears/update/{id}', [AdminEyewearController::class, 'update'])->name('admin.eyewears.update');
    Route::delete('/admin/eyewears/{id}', [AdminEyewearController::class, 'delete'])->name('admin.eyewears.delete');

    // Users CRUD
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'view']);
    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'edit']);
    Route::put('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');

    // Chatbot CRUD
    Route::get('/admin/chatbot', [AdminChatbotController::class, 'index'])->name('admin.chatbot');
    Route::post('/admin/chatbot', [AdminChatbotController::class, 'store'])->name('admin.chatbot.store');
    Route::get('/admin/chatbot/{id}', [AdminChatbotController::class, 'view']);
    Route::get('/admin/chatbot/edit/{id}', [AdminChatbotController::class, 'edit']);
    Route::put('/admin/chatbot/update/{id}', [AdminChatbotController::class, 'update'])->name('admin.chatbot.update');
    Route::delete('/admin/chatbot/{id}', [AdminChatbotController::class, 'delete'])->name('admin.chatbot.delete');

    // System Info
    Route::get('/admin/system-info', [AdminSystemController::class, 'index'])->name('admin.system-info');
    Route::get('/admin/system-info/create', [AdminSystemController::class, 'create'])->name('admin.system-info.create');
    Route::get('admin/system-info/edit', [AdminSystemController::class, 'edit'])->name('admin.system-info.edit');
    Route::put('/admin/system-info/update/{id?}', [AdminSystemController::class, 'update'])->name('admin.system-info.update');

});

 // Client Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':client'])->group(function () {
    // Dashboard
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
    // Appointment View
    Route::get('/client/appointments', [ClientAppointmentController::class, 'index'])->name('client.appointments');
    // Eyewear View
    Route::get('/client/eyewears', [ClientEyewearController::class, 'index'])->name('client.eyewears');
    // ACCOUNT DETAILS
    Route::get('/client/account_details', [ClientAccountController::class, 'index'])->name('client.account_details');
    Route::put('/client/account_details{id}', [ClientAccountController::class, 'update'])->name('client.update');
});

// Ophthal Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':ophthal'])->group(function () {

    Route::get('/ophthal/dashboard', [OphthalController::class, 'index'])->name('ophthal.dashboard');
    Route::get('/ophthal/patients', [OphthalController::class, 'patients'])->name('ophthal.patients');

    // Inside the existing middleware group for 'ophthal'
    Route::post('/ophthal/storePrescription', [OphthalController::class, 'storePrescription'])->name('ophthal.storePrescription');
    Route::get('/ophthal/appointments', [OphthalController::class, 'appointments'])->name('ophthal.appointments');
    Route::get('/ophthal/patients/{id}', [OphthalController::class, 'view']);
    Route::get('/ophthal/patients/edit/{id}', [OphthalController::class, 'edit']);

    // // DASHBOARD
    // Route::get('/ophthal/dashboard', [OphthalDashboardController::class, 'index'])->name('ophthal.dashboard');
    // // APPOINTMENTs
    // Route::get('/ophthal/appointments', [OphthalAppointmentController::class, 'index'])->name('ophthal.appointments');
    // // PATIENTS
    // Route::get('/ophthal/patients', [OphthalPatientController::class, 'patients'])->name('ophthal.patients');
    // Route::get('/ophthal/patients/{id}', [OphthalPatientController::class, 'view']);
    // Route::get('/ophthal/patients/edit/{id}', [OphthalPatientController::class, 'edit']);
    // Route::post('/ophthal/storePrescription', [OphthalPatientController::class, 'storePrescription'])->name('ophthal.storePrescription');
});


// Staff Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':staff'])->group(function () {
    
    // Dashboard Module
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/dashboard/get_appointments', [StaffDashboardController::class, 'getAppointments']);
    Route::get('/staff/dashboard/get_appointment_details', [StaffDashboardController::class, 'getAppointmentDetails']);

    // Patient Module
    Route::get('/staff/patients', [StaffPatientController::class, 'index'])->name('staff.patients');

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

    // Chatbot
    Route::get('/staff/chatbot', [StaffChatbotController::class, 'index'])->name('staff.chatbot');
    Route::post('/staff/chatbot', [StaffChatbotController::class, 'store'])->name('staff.chatbot.store');
    Route::get('/staff/chatbot/{id}', [StaffChatbotController::class, 'view']);
    Route::get('/staff/chatbot/edit/{id}', [StaffChatbotController::class, 'edit']);
    Route::put('/staff/chatbot/update/{id}', [StaffChatbotController::class, 'update'])->name('staff.chatbot.update');
    Route::delete('/staff/chatbot/{id}', [StaffChatbotController::class, 'delete'])->name('staff.chatbot.delete');
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


