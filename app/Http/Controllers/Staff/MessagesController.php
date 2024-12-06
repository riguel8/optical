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
        $conversations = ConversationModel::with(['client', 'staff'])
            ->where('status', 'open')
            ->orderBy('updated_at', 'desc')
            ->get();
    
        return view('staff.messages', compact('conversations'));
    }
    

    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
    
        $message = MessagesModel::create([
            'conversation_id' => $conversationId,
            'sender_id' => auth()->id(),
            'message' => $request->input('message'),
        ]);
    
        $conversation = ConversationModel::find($conversationId);
        $conversation->update([
            'last_message_at' => now(),
        ]);
    
        broadcast(new MessageSent(
            $conversationId,
            $message->sender_id,
            $message
        ))->toOthers();
    
        return response()->json([
            'status' => 'Message sent',
            'message' => $message,
        ]);
    }

    public function showMessagesView()
    {
        return view('staff.message', ['userId' => auth()->id()]);
    }

    public function fetchMessages($conversationId)
    {
        $messages = MessagesModel::with('sender')
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'message' => $message->message,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender->name ?? 'Unknown',
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });
    
        return response()->json($messages);
    }
    
}
