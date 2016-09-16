<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Retrieve the current model is belong to specific contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }
}
