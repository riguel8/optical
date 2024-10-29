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

    //Adding New Appointment (Modal)

 public function store(Request $request)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'age' => 'required|integer|min:0',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:now',
        ]);

        $patient = PatientModel::create([
            'complete_name' => $validated['complete_name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'contact_number' => $validated['contact_number'],
            'address' => $validated['address'],
        ]);

        AppointmentModel::create([
            'PatientID' => $patient->PatientID,
            'DateTime' => Carbon::parse($validated['date']),
            'Status' => 1,
        ]);

        return redirect()->back()->with('success', 'Appointment added successfully.');
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
