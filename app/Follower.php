<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['contributor_id', 'following'];

    public function contributor()
    {
        $this->belongsTo('Infogue\Contributor');
    }

    public function following()
    {
        $this->belongsTo('Infogue\Contributor', 'following');
    }
}
