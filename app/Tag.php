<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];

    public function articles()
    {
        $this->belongsToMany('Infogue\Article', 'article_tags')->withTimestamps();
    }
}
