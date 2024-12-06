<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MessagesModel;
use App\Models\User;
use Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversationId;
    public $senderId;
    public $message;

    public function __construct($conversationId, $senderId, $message)
    {
        $this->conversationId = $conversationId;
        $this->senderId = $senderId;
        $this->message = $message;

        Log::info('MessageSent event fired:', [
            'message' => $message,
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->conversationId);
    }
    

    public function broadcastAs()
    {
        return 'MessageSent';
    }

    public function broadcastWith()
    {

        $sender = User::find($this->senderId);

        return [
            'conversation_id' => $this->conversationId,
            'message' => is_object($this->message) ? $this->message->message : $this->message,
            'sender_id' => $this->senderId,
            'sender_name' => $sender ? $sender->name : 'Unknown User',
            'created_at' => now()->format('F j, Y, g:i a'),
        ];
    }
}
