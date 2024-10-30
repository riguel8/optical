<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\Eyewear;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('admin.dashboard', compact('title'));
    }

    public function appointments()
    {
        $title = 'Appointments';
        $appointments = AppointmentModel::with(['patient', 'staff'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.appointments', compact('appointments', 'title'));
    }

    public function eyewears()
    {
        $title = 'Eyewears';
        $eyewears = Eyewear::all();
        return view('admin.eyewears', compact('eyewears', 'title'));
    }

    // Adding New Eyewears (Modal)
    public function storeEyewear(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'Brand' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'FrameType' => 'nullable|string|max:255',
            'FrameColor' => 'nullable|string|max:255',
            'LensType' => 'nullable|string|max:255',
            'LensMaterial' => 'nullable|string|max:255',
            'QuantityAvailable' => 'required|integer|min:0',
            'Price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null; // Initialize variable to store the image name

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); 
            $image->storeAs('eyewears', $imageName, 'public'); // Store the image
        }

        // Create the Eyewear record
        $data = Eyewear::create([
            'Brand' => $validated['Brand'],
            'Model' => $validated['Model'],
            'FrameType' => $validated['FrameType'],
            'FrameColor' => $validated['FrameColor'],
            'LensType' => $validated['LensType'],
            'LensMaterial' => $validated['LensMaterial'],
            'QuantityAvailable' => $validated['QuantityAvailable'],
            'Price' => $validated['Price'],
            'ImagePath' => $imageName, // Store the image path in the database
        ]);

        // Return a response
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Eyewear added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add eyewear. Please try again later.',
            ]);
        }
    }


    // Adding New Appointment (Modal)
    public function storeAppointment(Request $request)
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
                'Status' => 'pending', 
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

    // Function to view specific appointment
    public function viewAppointment($id)
    {
        try {
            $appointment = AppointmentModel::with('patient')->findOrFail($id);
    
            return response()->json([
                'appointment' => [
                    'dateTime' => $appointment->DateTime,
                    'status' => $appointment->Status,
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

    // Function to Edit Appointment
    public function editAppointment($id)
    {
        try {
            $appointment = AppointmentModel::with('patient')->findOrFail($id);
    
            return response()->json([
                'appointment' => [
                    'dateTime' => $appointment->DateTime,
                    'status' => $appointment->Status,
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
public function updateAppointment(Request $request, $id)
{
    $request->validate([
        'DateTime' => 'required|date',
        'status' => 'required|string',
        'complete_name' => 'required|string',
        'age' => 'required|integer',
        'gender' => 'required|string',
        'contact_number' => 'required|string',
        'address' => 'required|string',
    ]);

    try {
        $appointment = AppointmentModel::findOrFail($id);
        $appointment->DateTime = $request->input('DateTime');
        $appointment->Status = $request->input('status');
        $appointment->save();

        $patient = $appointment->patient;
        $patient->complete_name = $request->input('complete_name');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->contact_number = $request->input('contact_number');
        $patient->address = $request->input('address');
        $patient->save();

        return response()->json(['success' => 'Appointment updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error updating appointment'], 500);
    }
}
    
    





    // ######### Patients Controller ######## //
    public function patients()
    {
        $title = 'Patients';
        $patients = PatientModel::with('prescription')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.patients', compact('patients', 'title'));
    }
}
