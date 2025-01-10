<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;



class UserController extends Controller
{
    public function index()
    {
        $title = 'Users';
        $users = User::all();
        return view('admin.users', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'usertype' => ['required', 'string', 'max:255'],
            ]);
    
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'usertype' => $validated['usertype'],
                'password' => Hash::make($validated['password']),
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add user. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // To view specific user
    public function view($id)
    {
        try {
            Log::info('Fetching user with ID: ' . $id);
    
            $user = User::find($id);
    
            if (!$user) {
                Log::error('User not found with ID: ' . $id);
    
                return response()->json(['error' => 'Data not found'], 404);
            }
    
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'usertype' => $user->usertype,
                    'created_at' => $user->created_at,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            
            return response()->json(['error' => 'Data not found'], 404);
        }
    }


    // Function to Fetch User Information
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
    
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'usertype' => $user->usertype,
                    'created_at' => $user->created_at,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
        
    //Function to Update the User
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'usertype' => 'required|string|in:admin,client,staff,optometrist',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
    
            $user = User::findOrFail($id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->usertype = $validatedData['usertype'];
    
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedData['password']);
            }
    
            $user->save();
    
            return response()->json([
                'status' => 'success',
                'message' => "The user '{$user->name}' has been successfully updated.",
            ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => "An error occurred while updating the user '{$user->name}'. Please try again later.",
                ]);
            }    
    }
}