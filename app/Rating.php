<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'ip', 'rate'];

    /**
     * Many-to-one relationship, retrieve article that owned this rating.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('Infogue\Article');
    }
}
