<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

// Default Route for Pages
Route::get('/', [PagesController::class, 'index'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
     // Admin
     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');;
     Route::get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');;
     Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');;
     Route::get('/admin/eyewears', [AdminController::class, 'index'])->name('admin.eyewears');;

    //Admin Modal
    Route::post('/appointments', [AdminController::class, 'add'])->name('appointments.add');


 
     // Client
     Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
     Route::get('/client/appointments', [ClientController::class, 'appointments'])->name('client.appointments');
     Route::get('/client/eyewears', [ClientController::class, 'eyewears'])->name('client.eyewears');
     Route::get('/client/account_details', [ClientController::class, 'account_details'])->name('client.account_details');
     Route::put('/client/account_details', [ClientController::class, 'updateAccount'])->name('client.updateAccount');
    
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


