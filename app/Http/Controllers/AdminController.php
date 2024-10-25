<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\Eyewear;
use Illuminate\Http\Request;
use App\Models\UserModel;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function appointments()
    {
        $appointments = AppointmentModel::with(['patient', 'staff'])
        ->orderBy('created_at', 'desc')
        ->get();

        
        return view('admin.appointments', compact('appointments'));
    }

    public function eyewears()
    {
        $eyewears = Eyewear::all();
        return view('admin.eyewears', compact('eyewears'));
    }

    //Adding New Appointment (Modal)

    public function store(Request $request)
    {
    $request->validate([
        'patient_name' => 'required|string|max:255',
        'email' => 'required|email',
        'address' => 'required|string',
        'contact' => 'required|string',
        'age' => 'required|integer',
        'appointment_date' => 'required|date',
    ]);
    AppointmentModel::create($request->all());
    return redirect()->back()->with('success', 'Appointment created successfully!');
    }

    // ######### Patients Controller ######## //
    public function patients()
    {
        $patients = PatientModel::with('prescription')
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.patients', compact('patients'));
    }
    

}
