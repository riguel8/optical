<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Default Route for Pages


Route::get('/', [PagesController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/auth/login', [AuthenticatedSessionController::class, 'index'])->name('login');
// Route::get('/auth/register', [RegistrationController::class, 'index'])->name('register');
// Route::post('/auth/register', [RegistrationController::class, 'register']);


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');;
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/patients', [PatientController::class, 'index']);
    // Route::get('/appointments', [AppointmentController::class, 'index']);
    // Route::get('/eyewears', [EyewearController::class, 'index']);

});

// // Dashboard Routes
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/dashboard/get_appointment_details', [DashboardController::class, 'getAppointmentDetails'])->name('dashboard.getAppointmentDetails');
// Route::get('/dashboard/get_appointments', [DashboardController::class, 'getAppointments'])->name('dashboard.getAppointments');
// Route::get('/dashboard/{any}', [DashboardController::class, 'view'])->where('any', '.*');

// // Users Routes
// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/view', [UserController::class, 'view'])->name('users.view');
// Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::get('/users/{any}', [UserController::class, 'view'])->where('any', '.*');

// // Patients Routes
// Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
// Route::get('/view_details', [PatientController::class, 'viewDetails'])->name('patients.viewDetails');
// Route::post('/patients/add', [PatientController::class, 'add'])->name('patients.add');
// Route::put('/patients/update', [PatientController::class, 'update'])->name('patients.update');
// Route::get('/edit', [PatientController::class, 'edit'])->name('patients.edit');
// Route::delete('/patients/delete', [PatientController::class, 'delete'])->name('patients.delete');
// Route::get('/patients/{any}', [PatientController::class, 'view'])->where('any', '.*');

// // Appointments Routes
// Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
// Route::get('/appointments/get_appointment_details', [AppointmentController::class, 'getAppointmentDetails'])->name('appointments.getAppointmentDetails');
// Route::get('/appointments/get_appointments', [AppointmentController::class, 'getAppointments'])->name('appointments.getAppointments');
// Route::get('/view_details', [AppointmentController::class, 'viewDetails'])->name('appointments.viewDetails');
// Route::put('/appointments/update', [AppointmentController::class, 'update'])->name('appointments.update');
// Route::post('/appointments/add', [AppointmentController::class, 'add'])->name('appointments.add');
// Route::get('/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
// Route::get('/appointments/{any}', [AppointmentController::class, 'view'])->where('any', '.*');

// // Eyewears Routes
// Route::get('/eyewears', [EyewearController::class, 'index'])->name('eyewears.index');
// Route::get('/view', [EyewearController::class, 'view'])->name('eyewears.view');
// Route::get('/edit', [EyewearController::class, 'edit'])->name('eyewears.edit');
// Route::get('/eyewears/{any}', [EyewearController::class, 'view'])->where('any', '.*');

// // Chatbot Routes
// Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
// Route::get('/chatbot/{any}', [ChatbotController::class, 'view'])->where('any', '.*');



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
