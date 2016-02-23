<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['contributor_id', 'activity'];

    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }
}
