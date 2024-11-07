<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $title = 'Appointments';
        $appointments = AppointmentModel::with(['patient', 'staff'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.appointments', compact('appointments', 'title'));
    }

    // Adding New Appointment (Modal)
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'complete_name' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female,Other',
                'age' => 'required|integer|min:0',
                'contact_number' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'DateTime' => 'required|date|after_or_equal:now',
            ]);

            $patient = PatientModel::create([
                'complete_name' => $validated['complete_name'],
                'gender' => $validated['gender'],
                'age' => $validated['age'],
                'contact_number' => $validated['contact_number'],
                'address' => $validated['address'],
                'DateTime' => $validated['DateTime'],
            ]);

            $user = auth()->user();
            $user->user_type === 'staff' || $user->user_type === 'admin';
                $staffId = $user->id;

            AppointmentModel::create([
                'PatientID' => $patient->PatientID,
                'StaffID' => $staffId,
                'DateTime' => Carbon::parse($validated['DateTime']),
                'Status' => 'Pending', 
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Patient and appointment were added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to appointment. Please try again later.',
            ]);
        }
    }

    // Function to Fetch Appointment Information
    public function edit($id)
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
    
    //Function to Update the Appointment
    public function update(Request $request, $id)
    {
        $request->validate([
            'DateTime' => 'required|date',
            'Status' => 'required|string',
            'complete_name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'contact_number' => 'required|string',
            'address' => 'required|string',
        ]);

        try {
            $appointment = AppointmentModel::findOrFail($id);
            $appointment->DateTime = $request->input('DateTime');
            $appointment->Status = $request->input('Status');
            $appointment->save();

            $patient = $appointment->patient;
            $patient->complete_name = $request->input('complete_name');
            $patient->age = $request->input('age');
            $patient->gender = $request->input('gender');
            $patient->contact_number = $request->input('contact_number');
            $patient->address = $request->input('address');
            $patient->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Appointment updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating appointment',
            ]);
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

    public function delete($id)
    {
        $appointment = AppointmentModel::findOrFail($id);
        if ($appointment->patient) {
            $appointment->patient->delete();
        }

        $appointment->delete();
    }
    
}
