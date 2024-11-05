<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AppointmentControllersssss extends Controller
{
    // Display the list of appointments with patient details
    public function index()
    {
        $appointments = AppointmentModel::with('patient')->get();
        return view('admin.appointments', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // Show patient appointment details
    public function viewDetails($patientID)
    {
        $patient = PatientModel::with('appointments')->find($patientID);
        return view('appointments.view_details', ['patient' => $patient, 'title' => 'View Details']);
    }

    // Fetch all appointments (for AJAX request)
    public function getAppointments()
    {
        $appointments = AppointmentModel::with('patient')->get();
        return response()->json($appointments);
    }

    // Get appointment details by ID (for AJAX request)
    public function getAppointmentDetails(Request $request)
    {
        $appointmentId = $request->query('appointmentId');
        $appointmentDetails = AppointmentModel::with('patient')->find($appointmentId);
        return response()->json($appointmentDetails);
    }

    // Show edit form for an appointment
    public function edit($appointmentID)
    {
        $appointment = AppointmentModel::find($appointmentID);
        return view('appointments.edit', ['appointment' => $appointment, 'title' => 'Edit Appointment']);
    }

    // Update an existing appointment
    public function update(Request $request)
    {
        $appointmentID = $request->input('appointment_id');
        $date = $request->input('date');
        $status = $request->input('status');

        $appointment = AppointmentModel::find($appointmentID);
        $appointment->DateTime = $date;
        $appointment->Status = $status;

        if ($appointment->save()) {
            return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
        } else {
            return back()->withErrors(['message' => 'Failed to update appointment.']);
        }
    }

    // Show add form and handle new appointment submission
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'complete_name' => 'required|string',
                'age' => 'required|integer',
                'address' => 'required|string',
                'contact_number' => 'required|string',
                'gender' => 'required|string',
                'date' => 'required|date',
            ]);

            try {
                DB::transaction(function () use ($request) {
                    $patient = PatientModel::create([
                        'complete_name' => $request->input('complete_name'),
                        'age' => $request->input('age'),
                        'address' => $request->input('address'),
                        'contact_number' => $request->input('contact_number'),
                        'gender' => $request->input('gender')
                    ]);

                    AppointmentModel::create([
                        'patientID' => $patient->id,
                        'DateTime' => $request->input('date'),
                        'Status' => 'pending'
                    ]);
                });
                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Failed to add appointment: ' . $e->getMessage()]);
            }
        }

        return view('admin.add', ['title' => 'Add Appointment']);
    }
}
