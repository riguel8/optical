<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\UserTypeMiddleware;
use App\Models\AppointmentModel;
use App\Models\PatientModel;

class OphthalController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('ophthal.dashboard', compact('title'));
    }

    public function appointments()
    {
        $title = 'Appointments';
        $appointments = AppointmentModel::all();
        return view('ophthal.appointments', compact('appointments','title'));
    }
    public function patients()
    {
        $title = 'Patients';
        $patients = PatientModel::all();
        return view('ophthal.patients', compact('patients','title'));
    }

}
