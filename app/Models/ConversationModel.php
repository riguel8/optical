<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MessagesModel;

class ConversationModel extends Model
{
    protected $table = 'conversations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'staff_id',
        'status',
        'last_message_at',
    ];

    public function messages()
    {
        return $this->hasMany(MessagesModel::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
