<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        // Get users from the model
        $users = User::getUsers();

        // Set the title (can be passed as a variable if needed)
        $title = 'User Management';

        // Return the view with data
        return view('users.index', compact('users', 'title'));
    }

    // View a single user profile
    public function view($userId)
    {
        // Load user data based on userid
        $user = User::getUserById($userId);
        $title = 'View Profile'; // Set the title as needed

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        // Return the view with data
        return view('users.view', compact('user', 'title'));
    }

    // Edit a user profile
    public function edit($userId)
    {
        $user = User::getUserById($userId);
        $title = 'Edit Profile';      
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        return view('users.edit', compact('user', 'title'));
    }

    public function login(Request $request)
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::authenticate($username, $password);

        if ($user) {
            session(['user' => $user]);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid login. User not found.');
        }
    }
}
