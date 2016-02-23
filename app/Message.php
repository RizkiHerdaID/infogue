<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function conversations()
    {
        $this->hasMany('Infogue\Conversation');
    }
}
