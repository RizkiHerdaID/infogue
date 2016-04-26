<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'name', 'email', 'comment'];
    
    public function article()
    {
        return $this->belongsTo('Infogue\Article');
    }
}
