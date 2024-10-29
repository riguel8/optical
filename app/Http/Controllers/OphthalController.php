<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;
use App\Models\PatientModel;
use Session;

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
        return view('ophthal.appointments', compact('appointments', 'title'));
    }

    public function patients()
    {
        $title = 'Patients';
        $patients = PatientModel::with('prescription')->get();
        return view('ophthal.patients', compact('patients', 'title'));
    }

    public function storePrescription(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|exists:patients,PatientID',
            'prescription' => 'required|string',
            'lens' => 'required|string',
            'frame' => 'required|string',
            'price' => 'required|numeric',
            'date' => 'required|date',
            'PrescriptionDetails' => 'required|string',
        ]);

        $doctorID = auth()->user()->id;

        PrescriptionModel::create([
            'DoctorID' => $doctorID,
            'PatientID' => $request->PatientID,
            'Prescription' => $request->prescription,
            'Lens' => $request->lens,
            'Frame' => $request->frame,
            'Price' => $request->price,
            'Date' => $request->date,
            'PrescriptionDetails' => $request->PrescriptionDetails,
        ]);

        return redirect()->back()->with('success', 'Prescription added successfully.');
    }
}
