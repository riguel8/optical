<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\UserModel;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function appointments()
    {
        $appointments = AppointmentModel::with(['patient', 'staff'])
        ->orderBy('created_at', 'desc')
        ->get();

        
        return view('admin.appointments', compact('appointments'));
    }

    public function eyewears()
    {
        return view('admin.eyewears');
    }
}
