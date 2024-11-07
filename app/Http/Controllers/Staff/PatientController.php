<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Patients';
        $patients = PatientModel::whereHas('appointments', function($query) {
            $query->where('appointments.Status', 'Completed');
        })
        ->get();

        return view('staff.patients', compact('patients', 'title'));
    }
}