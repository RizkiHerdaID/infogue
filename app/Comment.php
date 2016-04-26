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

    /**
     * Many-to-one relationship, related article.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('Infogue\Article');
    }

    /**
     * Many-to-one relationship, comment author.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }
}
