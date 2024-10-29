<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\Eyewear;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('staff.dashboard', compact('title'));
    }

    public function appointments()
    {
        $title = 'Appointments';
        $appointments = AppointmentModel::with(['patient', 'staff'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('staff.appointments', compact('appointments', 'title'));
    }

    public function eyewears()
    {
        $title = 'Eyewears';
        $eyewears = Eyewear::all();
        return view('staff.eyewears', compact('eyewears', 'title'));
    }

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

    public function storeEyewear(Request $request)
    {
        $request->validate([
            'Brand' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'FrameType' => 'nullable|string|max:255',
            'FrameColor' => 'nullable|string|max:255',
            'LensType' => 'nullable|string|max:255',
            'LensMaterial' => 'nullable|string|max:255',
            'QuantityAvailable' => 'required|integer',
            'Price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('eyewear_images', 'public');
        }

        Eyewear::create([
            'Brand' => $request->Brand,
            'Model' => $request->Model,
            'FrameType' => $request->FrameType,
            'FrameColor' => $request->FrameColor,
            'LensType' => $request->LensType,
            'LensMaterial' => $request->LensMaterial,
            'QuantityAvailable' => $request->QuantityAvailable,
            'Price' => $request->Price,
            'image' => $imagePath,  // Store the image path
        ]);

        return redirect()->back()->with('success', 'Eyewear added successfully!');
    }

    public function patients()
    {
        $title = 'Patients';
        $patients = PatientModel::with('prescription')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('staff.patients', compact('patients', 'title'));
    }
}
