<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConversationModel;

class MessagesModel extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
    ];

    public function conversation()
    {
        return $this->belongsTo(ConversationModel::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
