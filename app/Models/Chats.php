<?php

namespace App\Models;

class Chats extends BaseModel
{
    protected
        $table = 'chats',
        $fillable = ['updated_at', 'last_message_text'];
}
