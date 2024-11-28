<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MessagesModel;
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

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [new Channel('chat.' . $this->conversationId)];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }

    public function broadcastWith()
    {
        $message = MessagesModel::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => $this->senderId,
            'message' => $this->message,
        ]);
        return [
            'message' => $message->message,
            'sender_id' => $message->sender_id,
            'sender_name' => $message->sender->name,
            'created_at' => $message->created_at->format('F j, Y, g:i a'),
        ];
    }
}
