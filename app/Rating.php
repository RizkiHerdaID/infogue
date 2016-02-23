<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['article_id', 'ip', 'rate'];

    public function article()
    {
        $this->belongsTo('Infogue\Article');
    }
}
