<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;
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

    public function storePrescription(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|exists:patients,PatientID',
            'Lens' => 'required',
            'Frame' => 'required',
            'Price' => 'required|numeric',
            'Prescription' => 'required',
            'PrescriptionDetails' => 'required|string',
            'date' => 'required|date',
        ]);

        // Create a new prescription
        PrescriptionModel::create([
            'PatientID' => $request->input('PatientID'),
            'Lens' => $request->input('Lens'),
            'Frame' => $request->input('Frame'),
            'Price' => $request->input('Price'),
            'Prescription' => $request->input('Prescription'),
            'PrescriptionDate' => $request->input('date'),
            'PrescriptionDetails' => $request->input('PrescriptionDetails'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Prescription created successfully!');
    }


}
