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

// Function to view specific appointment
public function view($id)
{
    try {
        $appointment = AppointmentModel::with('patient')->findOrFail($id);

        return response()->json([
            'appointment' => [
                'DateTime' => $appointment->DateTime,
                'Status' => $appointment->Status,
            ],
            'patient' => [
                'complete_name' => $appointment->patient->complete_name,
                'age' => $appointment->patient->age,
                'gender' => $appointment->patient->gender,
                'contact_number' => $appointment->patient->contact_number,
                'address' => $appointment->patient->address,
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Data not found'], 404);
    }
}
    
}
