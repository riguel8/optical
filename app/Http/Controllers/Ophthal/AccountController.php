<?php

namespace App\Http\Controllers\Ophthal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $title = 'My Account';

        return view('ophthal.account-details', compact('user', 'title'));

    }
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
                'password' => 'nullable|string|min:8|confirmed',
            ]);
    
            $user = Auth::user();
            
            if ($user->id != $id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized action.',
                ], 403);
            }
            $changesMade = false;
            if ($user->name !== $validatedData['name'] || $user->email !== $validatedData['email']) {
                $changesMade = true;
            }
    
            if ($request->filled('password')) {
                $changesMade = true;
            }
    
            if (!$changesMade) {
                return redirect()->back()->with('status', 'no_changes')->with('message', 'No changes were made to the account.');
            }
    
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
    
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedData['password']);
            }
    
            if ($user->save()) {
                session(['name' => $user->name]);
                return redirect()->back()->with('status', 'success')->with('message', 'Account updated successfully.');
            }
    
            return redirect()->back()->with('status', 'error')->with('message', 'Failed to update account. Please try again.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Failed to update account. Please try again.');
        }
    }
    

}