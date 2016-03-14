<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contributor_id', 'following'];

    /**
     * Many-to-one relationship, retrieve contributor as follower.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    /**
     * Many-to-one relationship, retrieve contributor as following.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function following()
    {
        return $this->belongsTo('Infogue\Contributor', 'following');
    }
}
