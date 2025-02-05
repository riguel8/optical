<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Eyewear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\LOG;


class EyewearController extends Controller
{
    public function index()
    {
        $title = 'Eyewears';
        $eyewears = Eyewear::all();
        return view('staff.eyewears', compact('eyewears', 'title'));
    }

    public function view($id)
    {
        $title = 'Eyewear Details';
        $eyewear = Eyewear::findOrFail($id);
        return view('staff.view-details', compact('eyewear', 'title'));
    }

    
    // public function view($hashedId)
    // {
    //     $id = $this->decode($hashedId);
        
    //     $title = 'Eyewears';
    //     $eyewear = Eyewear::findOrFail($id);
    //     return view('staff.eyewears.view-details', compact('eyewear', 'title'));
    // }
    
    // public function encode($id)
    // {
    //     return base64_encode($id);
    // }
    
    // public function decode($hashedId)
    // {
    //     return base64_decode($hashedId);
    // }
    


    
    // Adding New Eyewears (Modal)
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validation = $request->validate([
                'Brand' => 'required|string|max:255',
                'Model' => 'required|string|max:255',
                'FrameType' => 'nullable|string|max:255',
                'FrameColor' => 'nullable|string|max:255',
                'LensType' => 'nullable|string|max:255',
                // 'LensMaterial' => 'nullable|string|max:255',
                // 'QuantityAvailable' => 'required|integer|min:0',
                'Price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName(); 
                $image->move(public_path('storage/eyewears'), $imageName);
                $validation['image'] = $imageName; 
            }

            Eyewear::create($validation);

            return response()->json([
                'status' => 'success',
                'message' => 'The eyewear has been successfully added.'
            ]);
            
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'There was an issue adding the eyewear. Please try again later.'
                ]);
            } 
    }

    
    public function edit($id)
    {
        $eyewear = Eyewear::findOrFail($id);
        return response()->json($eyewear); // Return the eyewear data as JSON
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Brand' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'FrameType' => 'nullable|string|max:255',
            'FrameColor' => 'nullable|string|max:255',
            'LensType' => 'nullable|string|max:255',
            // 'LensMaterial' => 'nullable|string|max:255',
            // 'QuantityAvailable' => 'required|integer',
            'Price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try{
            $eyewear = Eyewear::findOrFail($id);
            $eyewear->Brand = $request->Brand;
            $eyewear->Model = $request->Model;
            $eyewear->FrameType = $request->FrameType;
            $eyewear->FrameColor = $request->FrameColor;
            $eyewear->LensType = $request->LensType;
            // $eyewear->LensMaterial = $request->LensMaterial;
            // $eyewear->QuantityAvailable = $request->QuantityAvailable;
            $eyewear->Price = $request->Price;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName(); 
                $image->move(public_path('storage/eyewears'), $imageName);
                $eyewear['image'] = $imageName; 
            }
            $eyewear->save();

            return response()->json([
                'status' => 'success',
                'message' => 'The eyewear updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'There was an issue updating eyewear. Please try again.',
            ]);
        }
    }
    public function delete($id)
    {
        try {
            $eyewear = Eyewear::findOrFail($id);

            if ($eyewear->image && Storage::disk('public')->exists('eyewears/' . $eyewear->image)) {
                Storage::disk('public')->delete('eyewears/' . $eyewear->image);
            }

            $eyewear->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The eyewear have been successfully deleted.'
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting the eyewear entry: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while attempting to delete the eyewear. Please try again later.'
            ], 500);
        }
    }
}
