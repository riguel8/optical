<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\SendEmailNotification;

class AppointmentController extends Controller
{
    public function index()
    {
        $title = 'Appointments';
        $appointments = AppointmentModel::with(['patient', 'staff'])
            ->orderBy('DateTime', 'asc')
            ->get();
    
        return view('admin.appointments', compact('appointments', 'title'));
    }

        // Function to check the availability of the time slot
        public function checkAvailability(Request $request)
    {
        $selectedDate = $request->input('date');

        $appointments = AppointmentModel::whereDate('DateTime', $selectedDate)
            ->pluck('DateTime')
            ->toArray();

        $timeSlots = [];
        for ($hour = 10; $hour <= 21; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 30) {
                $timeSlots[] = sprintf('%02d:%02d', $hour, $minute);
            }
        }
        $unavailableSlots = [];
        foreach ($appointments as $appointment) {
            $appointmentTime = Carbon::parse($appointment)->format('H:i');
            if (in_array($appointmentTime, $timeSlots)) {
                $unavailableSlots[] = $appointmentTime;
            }
        }
        return response()->json([
            'unavailableSlots' => $unavailableSlots,
        ]);
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
                'appointment_date' => 'required|date|after:today',
                'appointment_time' => 'required|string',
            ]);

            $appointmentDateTime = Carbon::parse($validated['appointment_date'] . ' ' . $validated['appointment_time']);
    
            $patient = PatientModel::create([
                'complete_name' => $validated['complete_name'],
                'gender' => $validated['gender'],
                'age' => $validated['age'],
                'contact_number' => $validated['contact_number'],
                'address' => $validated['address'],
            ]);
    
            $user = auth()->user();
            $staffId = $user->id;

            AppointmentModel::create([
                'PatientID' => $patient->PatientID,
                'StaffID' => $staffId,
                'DateTime' => $appointmentDateTime,
                'Status' => 'Pending',
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Patient and appointment were added successfully',
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add patient and appointment. Please try again later.',
            ]);
        }
    }
    
    
    

    // Function to Fetch Appointment Information
public function edit($id)
{
    $appointment = AppointmentModel::findOrFail($id);
    $patient = PatientModel::find($appointment->PatientID);

    $formattedDateTime = Carbon::parse($appointment->DateTime)->format('Y-m-d\TH:i:s');
    $takenSlots = AppointmentModel::whereDate('DateTime', $appointment->DateTime->toDateString())
        ->pluck('DateTime')
        ->map(fn($dt) => Carbon::parse($dt)->format('H:i'))
        ->toArray();

    return response()->json([
        'appointment' => [
            'DateTime' => $formattedDateTime,
            'Status' => $appointment->Status,
            'Notes' => $appointment->Notes,
        ],
        'patient' => $patient,
        'takenSlots' => $takenSlots,
    ]);
}
    
    
    //Function to Update the Appointment
    public function update(Request $request, $appointmentId)
    {
        $request->validate([
            'DateTime' => 'required|date',
            'Status' => 'required|string|in:Pending,Confirm,Completed,Cancelled',  // Ensure valid status
            'complete_name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'Notes' => 'nullable|string',
            'contact_number' => 'required|string',
            'address' => 'required|string',
        ]);
    
        try {
            // Find the appointment and the related staff
            $appointment = AppointmentModel::with('staff')->findOrFail($appointmentId);
    
            // Check if the date/time has changed
            $isRescheduled = $appointment->DateTime !== $request->input('DateTime');
            $isStatusCancelled = $request->input('Status') === 'Cancelled';
    
            // Update the appointment details
            $appointment->DateTime = $request->input('DateTime');
            $appointment->Status = $request->input('Status');
            if ($request->has('Notes') && $request->input('Notes') !== null) {
                $appointment->Notes = $request->input('Notes');
            } else {
                $appointment->Notes = null;
            }
            $appointment->save();
    
            // Update the patient details
            $patient = $appointment->patient;
            $patient->complete_name = $request->input('complete_name');
            $patient->age = $request->input('age');
            $patient->gender = $request->input('gender');
            $patient->contact_number = $request->input('contact_number');
            $patient->address = $request->input('address');
            $patient->save();
    
            // If the status is cancelled, send a "Cancelled" notification
            if ($isStatusCancelled && $appointment->staff) {
                $appointment->staff->notify(new SendEmailNotification($appointment, 'Cancelled'));
            }
            
            // If the appointment was rescheduled (date/time changed), send a "Rescheduled" notification
            if ($isRescheduled && !$isStatusCancelled && $appointment->staff) {
                $appointment->staff->notify(new SendEmailNotification($appointment, 'Rescheduled'));
            }
    
            // If the status was updated but not cancelled, send status update notification
            if (!$isRescheduled && !$isStatusCancelled && $appointment->staff) {
                $appointment->staff->notify(new SendEmailNotification($appointment, $request->input('Status')));
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Appointment updated successfully and email notification sent.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating appointment: ' . $e->getMessage(),
            ], 500);
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

    // Accept or Decline Appointment
    public function updateAdminStatus(Request $request, $appointmentId)
    {
        $request->validate([
            'status' => 'required|in:Confirm,Cancelled',
            'note' => 'nullable|string|max:255',
        ]);

        try {
            $appointment = AppointmentModel::with('staff')->findOrFail($appointmentId);

            $appointment->Status = $request->input('status');
            $appointment->Notes = $request->input('note');
            $appointment->save();

            if ($appointment->staff) {
                $appointment->staff->notify(new SendEmailNotification($appointment, $request->input('status')));
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
