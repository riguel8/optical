<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table = "chatbot";
    protected $primaryKey = 'ChatbotID';

    protected $fillable = [
        'Question',
        'Response',
    ];
}
