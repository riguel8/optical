<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Show the login view
    public function index()
    {
        return view('auth.login');
    }

    // Authenticate the user
    public function authenticate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $email = $request->input('email');
        $password = $request->input('password');
    
        // Query the user by email
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // Check if the provided password matches the hashed password
            if (Hash::check($password, $user->password)) {
                // Authentication successful, set session data
                Session::put('usertype', $user->usertype);
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('id', $user->id);
    
                switch ($user->usertype) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'client':
                        return redirect()->route('client.dashboard');
                    case 'staff':
                        return redirect()->route('staff.dashboard');
                    case 'doctor':
                        return redirect()->route('doctor.dashboard');
                    default:
                        return redirect()->route('default.route'); 
                }
            } else {
                return back()->withErrors(['password' => 'Invalid Credentials'])->withInput();
            }
        } else {
            return back()->withErrors(['email' => 'User not found'])->withInput();
        }
    }
    
    // Logout the user
    public function logout()
    {
        // Unset all user data
        Session::forget(['usertype', 'name', 'email', 'id', 'is_admin', 'is_staff', 'is_patient']);

        // Destroy the session
        Session::flush();

        return redirect()->route('login')->with('status', 'Logout successful');
    }
}
