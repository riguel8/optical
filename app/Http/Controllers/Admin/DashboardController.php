<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\Eyewear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $patientCount = PatientModel::count();
        $appointmentCount = AppointmentModel::count();
        $eyewearCount = Eyewear::count();

        return view('admin.dashboard', compact( 'patientCount', 'appointmentCount', 'eyewearCount', 'title'));
    }

    public function getAppointments()
    {
        $appointments = DB::table('appointments as a')
            ->join('patients as p', 'a.patientID', '=', 'p.patientID')
            ->select(
                'a.AppointmentID as id',
                'p.complete_name as title',
                DB::raw("DATE_FORMAT(a.DateTime, '%Y-%m-%dT%H:%i:%s') as start"),
                'a.Status as status'
            )
            ->get();

        return response()->json($appointments);
    }

    public function getAppointmentDetails(Request $request)
    {
        $appointmentId = $request->get('appointmentId');

        $appointment = AppointmentModel::with('patient') 
            ->where('AppointmentID', $appointmentId) 
            ->first();

        if ($appointment) {
            return response()->json([
                'DateTime' => $appointment->DateTime,
                'complete_name' => $appointment->patient->complete_name,
                'age' => $appointment->patient->age,
                'gender' => $appointment->patient->gender,
                'contact_number' => $appointment->patient->contact_number,
                'address' => $appointment->patient->address,
                'Status' => $appointment->Status, 
            ]);
        } else {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
    }
}
