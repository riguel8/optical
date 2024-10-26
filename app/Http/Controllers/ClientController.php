<?php

namespace App\Http\Controllers;

use App\Models\Eyewear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('client.dashboard', compact( 'title'));
    }

    public function appointments()
    {
        $title = 'Appointments';
        return view('client.appointments', compact( 'title'));
    }

    // public function account_details()
    // {
    //     return view('client.account_details');
    // }
    public function account_details()
    {
        $user = Auth::user(); 
        $title = 'My Account';

        return view('client.account_details', compact('user', 'title'));
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($user->save()) {
            session([
                'name' => $user->name,
            ]);

            return redirect()->route('client.account_details')->with('success', 'Account updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update account');
        }
    }
    public function eyewears(Request $request)
    {
        $title = 'Eyewears';
        
        $brand = $request->input('brand');
        $frameType = $request->input('frame_type');
        $frameColor = $request->input('frame_color');
        $lensMaterial = $request->input('lens_material');

        $query = Eyewear::query();

        if ($brand) {
            $query->where('Brand', $brand);
        }
        if ($frameType) {
            $query->where('FrameType', $frameType);
        }
        if ($frameColor) {
            $query->where('FrameColor', $frameColor);
        }
        if ($lensMaterial) {
            $query->where('LensMaterial', $lensMaterial);
        }

        $eyewearProducts = $query->select('Brand', 'Model', 'FrameType', 'FrameColor', 'LensMaterial', 'Price', 'QuantityAvailable', 'image')->get();

        $brands = Eyewear::select('Brand')->distinct()->get();
        $frameTypes = Eyewear::select('FrameType')->distinct()->get();
        $frameColors = Eyewear::select('FrameColor')->distinct()->get();
        $lensMaterials = Eyewear::select('LensMaterial')->distinct()->get();

        return view('client.eyewears', compact('eyewearProducts', 'brands', 'frameTypes', 'frameColors', 'lensMaterials', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('eyewears', $imageName, 'public'); 
        }
        
        Eyewear::create([
            'Brand' => $request->input('Brand'),
            'Model' => $request->input('Model'),
            'FrameType' => $request->input('FrameType'),
            'FrameColor' => $request->input('FrameColor'),
            'LensType' => $request->input('LensType'),
            'LensMaterial' => $request->input('LensMaterial'),
            'Price' => $request->input('Price'),
            'QuantityAvailable' => $request->input('QuantityAvailable'),
            'image' => $imagePath, 
        ]);
    }
}
