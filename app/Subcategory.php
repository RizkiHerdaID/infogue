<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['subcategory', 'description'];

    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    public function category()
    {
        return $this->belongsTo('Infogue\Category');
    }
}
