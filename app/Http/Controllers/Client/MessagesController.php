<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConversationModel;
use App\Events\MessageSent;
use App\Models\MessagesModel;
use Illuminate\Http\Request;
use Auth;

class MessagesController extends Controller
{
public function getConversation($client_id)
{
    if (Auth::id() != $client_id) {
        abort(403, 'Unauthorized access.');
    }

    $conversation = ConversationModel::where('client_id', $client_id)->first();
    
    if (!$conversation) {
        $conversation = ConversationModel::create([
            'client_id' => $client_id,
            'staff_id' => 1,
        ]);
    }

    return response()->json([
        'conversation_id' => $conversation->id,
    ]);
}


    // Fetch messages for the conversation
    public function fetchMessages($conversation_id)
    {
        $messages = MessagesModel::where('conversation_id', $conversation_id)
            ->with('sender')
            ->get();
    
        return response()->json($messages);
    }

    public function getOrCreateConversation(Request $request)
{
    $clientId = $request->input('client_id');
    $conversation = ConversationModel::where('client_id', $clientId)->first();

    if (!$conversation) {
        $conversation = ConversationModel::create([
            'client_id' => $clientId,
        ]);
    }

    return response()->json([
        'conversation_id' => $conversation->id,
    ]);
}
    

    // Send a message in the conversation
    public function sendMessage(Request $request, $conversation_id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
        
        $message = MessagesModel::create([
            'conversation_id' => $conversation_id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);
        broadcast(new MessageSent($conversation_id, Auth::id(), $message));
        
        return response()->json([
            'id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id' => $message->sender_id,
            'sender_name' => $message->sender->name,
            'message' => $message->message,
            'created_at' => $message->created_at->format('F j, Y, g:i a'),
        ], 201);
    }
}
