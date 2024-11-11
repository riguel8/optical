<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use Illuminate\Http\Request;
use App\Models\PrescriptionModel;


class PatientController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Patients';
        $patients = PatientModel::whereHas('appointments', function($query) {
            $query->whereIn('appointments.Status', ['Confirm','Completed']);
        })
        ->get();

        return view('admin.patients', compact('patients', 'title'));
    }


    //Function to View Specific Patient
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
                    'prescription' => $prescription ? $prescription->Prescription : '',
                    'lens' => $prescription ? $prescription->Lens : '',
                    'frame' => $prescription ? $prescription->Frame : '',
                    'details' => $prescription ? $prescription->PrescriptionDetails : '',
                    'price' => $prescription ? $prescription->Price : '',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found', 'exception' => $e->getMessage()], 404);
        }
    }
    

    
    //Function to Fetch Data to Edit Modal
    public function edit($id)
    {
        try {
            $patient = PatientModel::with('prescription')->findOrFail($id);
    
            return response()->json([
                'patient' => [
                    'complete_name' => $patient->complete_name,
                    'age' => $patient->age,
                    'gender' => $patient->gender,
                    'contact_number' => $patient->contact_number,
                    'address' => $patient->address,
                ],
                'prescription' => $patient->prescription ? [
                    'prescription' => $patient->prescription->Prescription,
                    'lens' => $patient->prescription->Lens,
                    'frame' => $patient->prescription->Frame,
                    'details' => $patient->prescription->PrescriptionDetails,
                    'price' => $patient->prescription->Price,
                ] : null
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
    
    
    //Function to Update the Appointment
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'editpatientName' => 'required|string',
            'editage' => 'required|integer',
            'editgender' => 'required|string',
            'editcontactnumber' => 'required|string',
            'editaddress' => 'required|string',
            'editprescription' => 'required|string',
            'editlens' => 'required|string',
            'editframe' => 'required|string',
            'editprice' => 'required|numeric',
            'editprescriptionDetails' => 'required|string',
        ]);
    

        try {
            $patient = PatientModel::findOrFail($id);
            $patient->complete_name = $request->input('editpatientName');
            $patient->age = $request->input('editage');
            $patient->gender = $request->input('editgender');
            $patient->contact_number = $request->input('editcontactnumber');
            $patient->address = $request->input('editaddress');
            $patient->save();
    
            // Update prescription (if any)
            if ($patient->prescription) {
                $prescription = $patient->prescription;
            } else {
                $prescription = new PrescriptionModel();
                $prescription->PatientID = $patient->PatientID;
            }
    
            $prescription->Prescription = $request->input('editprescription');
            $prescription->Lens = $request->input('editlens');
            $prescription->Frame = $request->input('editframe');
            $prescription->Price = $request->input('editprice');
            $prescription->PrescriptionDetails = $request->input('editprescriptionDetails');
            $prescription->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Patient and Prescription updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating patient and prescription',
            ]);
        }
    }
    
    
    
}