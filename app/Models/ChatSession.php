<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $table = 'chat_sessions';

    protected $primaryKey = 'id_sessions';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'status_chat',
        'started_at',
        'ended_at'
    ];

    public function messages()
    {
        return $this->hasMany(ChatbotMessage::class, 'id_sessions', 'id_sessions');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}