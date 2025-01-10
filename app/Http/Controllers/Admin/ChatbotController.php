<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\LOG;

class ChatbotController extends Controller
{
    public function index()
    {
        $title = 'Chatbot';
        $chatbots = Chatbot::all();
        return view('admin.chatbot', compact('chatbots', 'title'));
    }
    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'Question' => 'required|string',
                'Response' => 'required|string',
            ]);

            Chatbot::create($validation);

            return response()->json([
                'status' => 'success',
                'message' => 'The question and response have been successfully added.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request. Please try again later.',
            ]);
        }
    }

    
    public function edit($id)
    {
        $chatbot = Chatbot::findOrFail($id);
        return response()->json($chatbot); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Question' => 'required|string|max:255',
            'Response' => 'required|string|max:255',
        ]);

        try{
            $chatbot = Chatbot::findOrFail($id);
            $chatbot->Question = $request->Question;
            $chatbot->Response = $request->Response;
            $chatbot->save();

            return response()->json([
                'status' => 'success',
                'message' => 'The question and response have been updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update the question and response. Please try again later.'
            ]);
        }
    }
    
    public function delete($id)
    {
        try {
            $chatbot = Chatbot::findOrFail($id);
            $chatbot->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'The question and response have been successfully deleted.'
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting the chatbot entry: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while attempting to delete the question and response. Please try again later.'
            ], 500);
        }
    }
    
}

