<?php
namespace App\Http\Controllers;

use App\Models\Eyewear;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        // Eyewear data
        $query = Eyewear::query();
        $eyewearProducts = $query->select('Brand', 'Model', 'FrameType', 'FrameColor', 'LensMaterial', 'Price', 'QuantityAvailable', 'image')->get();
        $groupedByBrand = $eyewearProducts->groupBy('Brand');
        $brands = Eyewear::select('Brand')->distinct()->get();
        $frameTypes = Eyewear::select('FrameType')->distinct()->get();
        $frameColors = Eyewear::select('FrameColor')->distinct()->get();
        $lensMaterials = Eyewear::select('LensMaterial')->distinct()->get();

        // Chatbot data
        $questions = Chatbot::select('ChatbotID', 'Question')->get();

        return view('landing.index', compact('groupedByBrand', 'brands', 'frameTypes', 'frameColors', 'lensMaterials', 'questions'));
    }
    public function getInitialQuestions()
    {
        // Get first 3 questions ordered by ID
        $questions = Chatbot::orderBy('ChatbotID')
            ->take(3)
            ->get(['ChatbotID', 'Question']);
            
        return response()->json($questions);
    }

    public function fetchResponse(Request $request)
    {
        $chatbotId = $request->input('chatbot_id');
        $chatbot = Chatbot::find($chatbotId);
        
        if (!$chatbot) {
            return response()->json([
                'answer' => 'I apologize, I couldn\'t find an answer to that question.',
                'related_questions' => []
            ]);
        }

        // Get next 3 questions in order
        $nextQuestions = Chatbot::where('ChatbotID', '>', $chatbotId)
            ->orderBy('ChatbotID')
            ->take(3)
            ->get(['ChatbotID', 'Question']);

        return response()->json([
            'answer' => $chatbot->Response,
            'related_questions' => $nextQuestions
        ]);
    }
    // public function fetchResponse(Request $request)
    // {
    //     $chatbotId = $request->input('chatbot_id');
    //     $response = Chatbot::where('ChatbotID', $chatbotId)->value('Response');

    //     return response()->json(['answer' => $response ?? 'Sorry, no response found.']);
    // }
}
