<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = ['name', 'email', 'message', 'label'];

    public function reply()
    {

    }

    public function mark_as_important($id)
    {

    }

    public function mark_as_archived($id)
    {

    }
}
