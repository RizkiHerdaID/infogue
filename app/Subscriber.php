<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email'];

    protected $hidden = ['created_at', 'updated_at'];
}
