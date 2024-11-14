<?php
namespace App\Http\Controllers;

use App\Models\Eyewear;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $query = Eyewear::query();
        $eyewearProducts = $query->select('Brand', 'Model', 'FrameType', 'FrameColor', 'LensMaterial', 'Price', 'QuantityAvailable', 'image')->get();

        $groupedByBrand = $eyewearProducts->groupBy('Brand');

        $brands = Eyewear::select('Brand')->distinct()->get();
        $frameTypes = Eyewear::select('FrameType')->distinct()->get();
        $frameColors = Eyewear::select('FrameColor')->distinct()->get();
        $lensMaterials = Eyewear::select('LensMaterial')->distinct()->get();

        return view('landing.index', compact('groupedByBrand', 'brands', 'frameTypes', 'frameColors', 'lensMaterials'));
    }
    public function getChatbotResponse(Request $request)
    {
        $question = $request->input('question');
        $response = Chatbot::where('Question', $question)->value('Response');

        return response()->json(['response' => $response]);
    }
}
