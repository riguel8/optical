<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Middleware\RedirectIfAuthenticated;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function appointments()
    {
        return view('admin.appointments');
    }

    public function eyewears()
    {
        return view('admin.eyewears');
    }
}
