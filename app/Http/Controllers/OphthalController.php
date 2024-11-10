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
    
        $patients = PatientModel::with(['prescription', 'appointments' => function ($query) {
            $query->whereIn('Status', ['confirm', 'completed']);
        }])
        ->whereHas('appointments', function ($query) {
            $query->whereIn('Status', ['confirm', 'completed']);
        })
        ->get();
    
        return view('ophthal.patients', compact('patients', 'title'));
    }



    //Function to View Specific Patient with Prescription
    public function view($patientId)
    {
        $patient = PatientMOdel::find($patientId);
        $prescription = PrescriptionModel::where('PatientID', $patientId)->first();

        return response()->json([
            'patients' => $patient,
            'prescriptions' => $prescription
        ]);
    }



    // Function to Fetch data to the modal
    public function edit($patientId)
    {
        try {
            $patient = PatientModel::with('prescription')->findOrFail($patientId);
    
            return response()->json([
                'patient' => [
                    'PatientID' => $patient->PatientID,
                    'complete_name' => $patient->complete_name,
                    'age' => $patient->age,
                    'gender' => $patient->gender,
                    'contact_number' => $patient->contact_number,
                    'address' => $patient->address,
                ],
                'prescription' => [
                    'PrescriptionID' => $patient->prescription->PrescriptionID ?? null,
                    'Lens' => $patient->prescription->Lens ?? null,
                    'Frame' => $patient->prescription->Frame ?? null,
                    'Price' => $patient->prescription->Price ?? null,
                    'Prescription' => $patient->prescription->Prescription ?? null,
                    'PrescriptionDetails' => $patient->prescription->PrescriptionDetails ?? null,
                    'PrescriptionDate' => $patient->prescription->PrescriptionDate ?? null,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }



    // Function to store prescription
    // public function storePrescription(Request $request)
    // {
    //     $request->validate([
    //         'PatientID' => 'required|exists:patients,PatientID',
    //         'prescription' => 'required|string',
    //         'lens' => 'required|string',
    //         'frame' => 'required|string',
    //         'price' => 'required|numeric',
    //         'date' => 'required|date',
    //         'PrescriptionDetails' => 'required|string',
    //     ]);

    //     $doctorID = auth()->user()->id;

    //     PrescriptionModel::create([
    //         'DoctorID' => $doctorID,
    //         'PatientID' => $request->PatientID,
    //         'Prescription' => $request->prescription,
    //         'Lens' => $request->lens,
    //         'Frame' => $request->frame,
    //         'Price' => $request->price,
    //         'Date' => $request->date,
    //         'PrescriptionDetails' => $request->PrescriptionDetails,
    //     ]);

    //     return redirect()->back()->with('success', 'Prescription added successfully.');
    // }
}
