<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['date', 'hit', 'unique'];
}
