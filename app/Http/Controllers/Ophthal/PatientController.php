<?php

namespace App\Http\Controllers\Ophthal;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use App\Models\PrescriptionModel;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index(Request $request)
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

}