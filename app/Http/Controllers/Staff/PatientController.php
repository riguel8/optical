<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use App\Models\PrescriptionModel;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Patients';
        $patients = PatientModel::whereHas('appointments', function($query) {
            $query->whereIn('appointments.Status', ['Confirm','Completed']);
        })
        ->get();

        return view('staff.patients', compact('patients', 'title'));
    }

    public function view($id)
    {
        try {
            $patient = PatientModel::with('prescription')->findOrFail($id);
            $prescription = $patient->prescription;
    
            return response()->json([
                'patient' => [
                    'complete_name' => $patient->complete_name,
                    'age' => $patient->age,
                    'gender' => $patient->gender,
                    'contact_number' => $patient->contact_number,
                    'address' => $patient->address,
                ],
                'prescription' => [
                    'prescription' => $prescription ? $prescription->Prescription : 'Not Available',
                    'lens' => $prescription ? $prescription->Lens : 'Not Available',
                    'frame' => $prescription ? $prescription->Frame : 'Not Available',
                    'details' => $prescription ? $prescription->PrescriptionDetails : 'Not Available',
                    'price' => $prescription ? $prescription->Price : 'Not Available',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found', 'exception' => $e->getMessage()], 404);
        }
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

    public function storePrescription(Request $request)
    {
        $validated = $request->validate([
            'PatientID' => 'required|exists:patients,PatientID',
            'edit_prescription' => 'required|string',
            'edit_lens' => 'required|string',
            'edit_frame' => 'required|string',
            'edit_price' => 'required|numeric',
            'edit_PrescriptionDetails' => 'required|string',
        ]);
    
        $user = auth()->user();
        $doctorID = $user->id;
    
        $patient = PatientModel::find($validated['PatientID']);
        
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        $prescription = PrescriptionModel::where('PatientID', $validated['PatientID'])->first();
    
        if ($prescription) {
            $prescription->update([
                'Lens' => $validated['edit_lens'],
                'Frame' => $validated['edit_frame'],
                'Price' => $validated['edit_price'],
                'Prescription' => $validated['edit_prescription'],
                'PrescriptionDetails' => $validated['edit_PrescriptionDetails'],
            ]);
            return response()->json(['success' => true, 'message' => 'Prescription updated successfully.']);
        } else {
            PrescriptionModel::create([
                'PatientID' => $validated['PatientID'],
                'Lens' => $validated['edit_lens'],
                'Frame' => $validated['edit_frame'],
                'Price' => $validated['edit_price'],
                'Prescription' => $validated['edit_prescription'],
                'PrescriptionDetails' => $validated['edit_PrescriptionDetails'],
                'DoctorID' => $doctorID,
            ]);
            return response()->json(['success' => true, 'message' => 'Prescription saved successfully.']);
        }
    }
}