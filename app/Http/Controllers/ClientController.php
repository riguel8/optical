<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.dashboard');
    }

    public function appointments()
    {
        return view('client.appointments');
    }

    public function eyewears()
    {
        return view('client.eyewears');
    }
}
