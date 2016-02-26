<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function activities()
    {
        return $this->hasMany('Infogue\Activity');
    }

    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    public function messages()
    {
        return $this->hasMany('Infogue\Message', 'from');
    }

    public function followers()
    {
        return $this->hasMany('Infogue\Follower', 'following');
    }

    public function following()
    {
        return $this->hasMany('Infogue\Follower');
    }
}
