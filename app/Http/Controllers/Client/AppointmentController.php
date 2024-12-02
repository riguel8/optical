<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\Chatbot;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;   

class AppointmentController extends Controller
{
    public function index()
    {
        $title = 'Appointments';

        $staffId = Auth::id();
    
        $appointments = AppointmentModel::with('patient')
            ->where('StaffID', $staffId)
            ->orderBy('DateTime', 'desc')
            ->get();

        $questions = Chatbot::select('ChatbotID', 'Question')->get();

        return view('client.appointments', compact('title', 'questions','appointments'));
    }


    // Function to check the availability of the time slot
    public function checkclientAvailability(Request $request)
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
                'message' => 'Appointment request were added successfully',
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add appointment request. Please try again later.',
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
        ],
        'patient' => $patient,
        'takenSlots' => $takenSlots,
    ]);
}
   
   
   //Function to Update the Appointment
   public function update(Request $request, $id)
   {
       $request->validate([
           'complete_name' => 'required|string',
           'age' => 'required|integer',
           'gender' => 'required|string',
           'contact_number' => 'required|string',
           'address' => 'required|string',
           'DateTime' => 'required|string',
       ]);
   
       try {
           $appointment = AppointmentModel::findOrFail($id);

           $appointment->DateTime = Carbon::parse($request->input('DateTime'));
           
           // $appointment->DateTime = $appointmentDateTime;
        //    $appointment->Status = $request->input('Status');
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
               'message' => 'Error updating appointment: ' . $e->getMessage(),
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
}