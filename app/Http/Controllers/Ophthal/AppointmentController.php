<?php

namespace App\Http\Controllers\Ophthal;

use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;

class AppointmentController extends Controller
{
    public function index()
    {
        {
            $title = 'Appointments';
            $appointments = AppointmentModel::all();
            return view('ophthal.appointments', compact('appointments', 'title'));
        }
    }
    
}
