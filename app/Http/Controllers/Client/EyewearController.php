<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Eyewear;
use Illuminate\Http\Request;

class EyewearController extends Controller
{
    public function index(Request $request)
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
}
