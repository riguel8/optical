<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index(){
        $title = 'Appointments';
        return view('client.appointments', compact( 'title'));
    }
}