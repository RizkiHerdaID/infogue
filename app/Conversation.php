<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['message_id', 'sender', 'receiver', 'message', 'is_available_sender', 'is_available_receiver'];

    public function receiver()
    {
        $this->belongsTo('Infogue\Contributor', 'receiver');
    }

    public function sender()
    {
        $this->belongsTo('Infogue\Contributor', 'sender');
    }

    public function attachment()
    {
        $this->hasOne('Infogue\Attachment');
    }
}
