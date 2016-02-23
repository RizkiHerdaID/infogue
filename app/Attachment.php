<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['message_id', 'file'];

    public function message()
    {
        $this->belongsTo('Infogue\Message');
    }
}
