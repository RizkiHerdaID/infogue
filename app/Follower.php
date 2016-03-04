<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['contributor_id', 'following'];

    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    public function following()
    {
        return $this->belongsTo('Infogue\Contributor', 'following');
    }
}
