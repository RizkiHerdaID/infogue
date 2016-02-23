<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from', 'to', 'message'];

    public function sender()
    {
        $this->belongsTo('Infogue\Contributor', 'from');
    }

    public function receiver()
    {
        $this->belongsTo('Infogue\Contributor', 'to');
    }

    public function attachment()
    {
        $this->hasOne('Infogue\Attachment');
    }
}
