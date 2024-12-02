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
use App\Http\Controllers\Staff\MessagesController as StaffMessagesController;
use App\Http\Controllers\Staff\AccountController as StaffAccountController;
// CLIENT
use App\Http\Controllers\Client\EyewearController as ClientEyewearController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\AccountController as ClientAccountController;
use App\Http\Controllers\Client\PrescriptionController as ClientPrescriptionController;
use App\Http\Controllers\Client\MessagesController as ClientMessagesController;
// OPHTHAL
use App\Http\Controllers\Ophthal\DashboardController as OphthalDashboardController;
use App\Http\Controllers\Ophthal\AppointmentController as OphthalAppointmentController;
use App\Http\Controllers\Ophthal\PatientController as OphthalPatientController;
use App\Http\Controllers\Ophthal\AccountController as OphthalAccountController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Broadcast;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');
Route::post('/fetch-response', [PagesController::class, 'fetchResponse'])->name('fetchResponse');

// Admin Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':admin'])->group(function () {
    
    // Dashboard Module
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/get_appointments', [AdminDashboardController::class, 'getAppointments']);
    Route::get('/admin/dashboard/get_appointment_details', [AdminDashboardController::class, 'getAppointmentDetails']);

    // Dashboard Module
    // Route::post('/admin/appointments/storeEyewear', [AdminController::class, 'storeEyewear'])->name('admin.storeEyewear');
    // Route::post('/admin/appointments/storeAppointment', [AdminController::class, 'storeAppointment'])->name('admin.storeAppointment');

    // Patient (View & Edit)
    Route::get('/admin/patients', [AdminPatientController::class, 'index'])->name('admin.patients');
    Route::get('/admin/patients/{id}', [AdminPatientController::class, 'view']);
    // To Store Walk-in Patient with Prescription
    Route::post('/admin/patients/store', [AdminPatientController::class, 'store'])->name('admin.patients.store');
    // To Add Prescription for Patient from Appointments
    Route::get('/admin/patients/edit/{id}', [AdminPatientController::class, 'edit']);
    Route::post('/admin/patients/update', [AdminPatientController::class, 'update'])->name('admin.patients.update');
    
    // Appointment CRUD
    Route::get('/admin/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments');
    Route::post('/admin/appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
    Route::get('/admin/appointments/{id}', [AdminAppointmentController::class, 'view']);
    Route::get('/admin/appointments/edit/{id}', [AdminAppointmentController::class, 'edit']);
    Route::put('/admin/appointments/update/{id}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/admin/appointments/{id}', [AdminAppointmentController::class, 'delete'])->name('admin.appointments.delete');
    // Calendar Time Slot Availability
    Route::get('/appointments/check-availability', [AdminAppointmentController::class, 'checkAvailability']);
    // Accept or Decline Appointment
    // Route::post('/admin/appointments/{appointment}/update-status', [AdminAppointmentController::class, 'updateAdminStatus'])->name('admin.appointments.updateAdminStatus');
    // SEND EMAIL
    // In routes/web.php or routes/api.php depending on your setup
    Route::post('/admin/appointments/{id}/update-status', [AdminAppointmentController::class, 'updateAdminStatus']);

    Route::post('/admin/appointments/{appointmentId}/send-email', [AdminAppointmentController::class, 'sendEmailNotification']);


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
    
    // Appointment CRUD
    Route::get('/client/appointments', [ClientAppointmentController::class, 'index'])->name('client.appointments');
    Route::post('/client/appointments', [ClientAppointmentController::class, 'store'])->name('client.appointments.store');
    Route::get('/client/appointments/edit/{id}', [ClientAppointmentController::class, 'edit']);
    Route::put('/client/appointments/update/{id}', [ClientAppointmentController::class, 'update'])->name('client.appointments.update');
    Route::get('/client/appointments/{id}', [ClientAppointmentController::class, 'view']);
    // Calendar Time Slot Availability
    Route::get('/appointments/check-client-availability', [ClientAppointmentController::class, 'checkclientAvailability']);

    // Prescription View
    Route::get('/client/prescription', [ClientPrescriptionController::class, 'index'])->name('client.prescription');
    Route::get('/client/prescription/{id}', [ClientPrescriptionController::class, 'show']);

    // Eyewear View
    Route::get('/client/eyewears', [ClientEyewearController::class, 'index'])->name('client.eyewears');

    // ACCOUNT DETAILS
    Route::get('/client/account-details', [ClientAccountController::class, 'index'])->name('client.account-details');
    Route::put('/client/account-details{id}', [ClientAccountController::class, 'update'])->name('client.update');
});

// Ophthal Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':ophthal'])->group(function () {

    Route::get('/ophthal/dashboard', [OphthalDashboardController::class, 'index'])->name('ophthal.dashboard');
    Route::get('/ophthal/dashboard/get_appointments', [OphthalDashboardController::class, 'getAppointments']);
    Route::get('/ophthal/dashboard/get_appointment_details', [OphthalDashboardController::class, 'getAppointmentDetails']);

    // Appointments
    Route::get('/ophthal/appointments', [OphthalAppointmentController::class, 'index'])->name('ophthal.appointments');
    Route::get('/ophthal/appointments/{id}', [OphthalAppointmentController::class, 'view']);

    //Patient CRUD
    Route::get('/ophthal/patients', [OphthalPatientController::class, 'index'])->name('ophthal.patients');
    Route::get('/ophthal/patients/{id}', [OphthalPatientController::class, 'view']);
    // To Store Walk-in Patient with Prescription
    Route::post('/ophthal/patients/store', [OphthalPatientController::class, 'store'])->name('ophthal.patients.store');
    // To Add Prescription for Patient from Appointments
    Route::get('/ophthal/patients/edit/{id}', [OphthalPatientController::class, 'edit']);
    Route::post('/ophthal/patients/update', [OphthalPatientController::class, 'update'])->name('ophthal.patients.update');

     // ACCOUNT DETAILS
     Route::get('/ophthal/account-details', [OphthalAccountController::class, 'index'])->name('ophthal.account-details');
     Route::put('/ophthal/account-details{id}', [OphthalAccountController::class, 'update'])->name('ophthal.update');
});


// Staff Modules
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserTypeMiddleware::class . ':staff'])->group(function () {
    
    // Dashboard Module
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/dashboard/get_appointments', [StaffDashboardController::class, 'getAppointments']);
    Route::get('/staff/dashboard/get_appointment_details', [StaffDashboardController::class, 'getAppointmentDetails']);

    // Patient Module
    Route::get('/staff/patients', [StaffPatientController::class, 'index'])->name('staff.patients');
    Route::get('/staff/patients/{id}', [StaffPatientController::class, 'view']);
    // To Store Walk-in Patient with Prescription
    Route::post('/staff/patients/store', [StaffPatientController::class, 'store'])->name('staff.patients.store');
    // To Add Prescription for Patient from Appointments
    Route::get('/staff/patients/edit/{id}', [StaffPatientController::class, 'edit']);
    Route::post('/staff/patients/update', [StaffPatientController::class, 'update'])->name('staff.patients.update');

    // Appointment CRUD
    Route::get('/staff/appointments', [StaffAppointmentController::class, 'index'])->name('staff.appointments');
    Route::post('/staff/appointments', [StaffAppointmentController::class, 'store'])->name('staff.appointments.store');
    Route::get('/staff/appointments/{id}', [StaffAppointmentController::class, 'view']);
    Route::get('/staff/appointments/edit/{id}', [StaffAppointmentController::class, 'edit']);
    Route::put('/staff/appointments/update/{id}', [StaffAppointmentController::class, 'update'])->name('staff.appointments.update');
    Route::delete('/staff/appointments/{id}', [StaffAppointmentController::class, 'delete'])->name('staff.appointments.delete');
    // Calendar Time Slot Availability
    Route::get('/appointments/check-staff-availability', [StaffAppointmentController::class, 'checkstaffAvailability']);
    // Accept or Decline Appointment
    Route::post('/staff/appointments/{appointment}/update-status', [StaffAppointmentController::class, 'updateStaffStatus'])->name('staff.appointments.updateStaffStatus');

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

    // ACCOUNT DETAILS
    Route::get('/staff/account-details', [StaffAccountController::class, 'index'])->name('staff.account-details');
    Route::put('/staff/account-details{id}', [StaffAccountController::class, 'update'])->name('staff.update');

    // Messages
    Route::get('/staff/messages', [StaffMessagesController::class, 'index'])->name('staff.messages');
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



// --------------- CHAAATSSSS
Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    return $user->conversations->contains('id', $conversationId);
    
});
Route::get('/staff/conversation/{conversation}/messages', [StaffMessagesController::class, 'fetchMessages']);
Route::post('/staff/conversation/{conversationId}/send-message', [StaffMessagesController::class, 'sendMessage']);


Route::get('/client/conversations/{client_id}', [ClientMessagesController::class, 'getConversation']);
Route::get('/client/conversation/{conversation_id}/messages', [ClientMessagesController::class, 'fetchMessages']);
Route::post('/client/conversation/{conversation_id}/send-message', [ClientMessagesController::class, 'sendMessage']);
Route::get('/client/conversation/{userId}', [ClientMessagesController::class, 'getConversation']);


Broadcast::channel('private-chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

require __DIR__.'/auth.php';


