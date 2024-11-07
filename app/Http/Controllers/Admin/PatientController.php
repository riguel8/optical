<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Patients';
        $patients = PatientModel::whereHas('appointments', function($query) {
            $query->whereIn('appointments.Status', ['Confirm','Completed']);
        })
        ->get();

        return view('admin.patients', compact('patients', 'title'));
    }
}