<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $title = 'Chatbot';
        $chatbots = Chatbot::all();
        return view('staff.chatbot', compact('chatbots', 'title'));
    }
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validation = $request->validate([
                'Question' => 'required|string|max:255',
                'Response' => 'required|string|max:255',
            ]);

            Chatbot::create($validation);

            return response()->json([
                'status' => 'success',
                'message' => 'Question and Response added successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add Question and Response. Please try again.',
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
                'message' => 'Question and Response updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update Question and Response. Please try again.',
            ]);
        }
    }

    
    public function delete($id)
    {
        $chatbot = Chatbot::findOrFail($id);
        $chatbot->delete();
    }
}

