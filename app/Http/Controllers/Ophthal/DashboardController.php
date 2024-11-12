<?php

namespace App\Http\Controllers\Ophthal;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('ophthal.dashboard', compact('title'));
    }
}