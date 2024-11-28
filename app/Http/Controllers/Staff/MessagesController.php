<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ConversationModel;
use App\Events\MessageSent;
use App\Models\MessagesModel;
use Illuminate\Http\Request;


class MessagesController extends Controller
{
    public function index()
    {
        $conversations = ConversationModel::with(['client', 'staff'])->where('status', 'open')->get();
        return view('staff.messages', compact('conversations'));
    }

    // To Send Message
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
    
        $message = $request->input('message');
        $senderId = auth()->id();
    
        $messageModel = MessagesModel::create([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => $message,
        ]);
    
        broadcast(new MessageSent($conversationId, $senderId, $messageModel));
    
        return response()->json(['status' => 'Message sent']);
    }
    

    // Fetches Current Login ID
    public function showMessagesView()
    {
    return view('staff.message', ['userId' => auth()->id()]);
    }

    // To fetch Messages to the chat-tab(Modal)
    public function fetchMessages($conversationId)
    {
    $messages = MessagesModel::with('sender')
        ->where('conversation_id', $conversationId)
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json($messages);
    }

    


}