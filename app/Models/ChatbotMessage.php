<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    protected $table = 'chat_messages';

    protected $primaryKey = 'id_messages';

    public $timestamps = false;

    protected $fillable = [
        'id_sessions',
        'sender',
        'message',
        'properti_data',
        'created_at'
    ];

    public function session()
    {
        return $this->belongsTo(
            ChatSession::class,
            'id_sessions',
            'id_sessions'
        );
    }
}