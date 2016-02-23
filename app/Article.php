<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function author()
    {
        return $this->belongsTo('Infogue\Contributor', 'author');
    }

    public function subcategory()
    {
        return $this->belongsTo('Infogue\Subcategory', 'label');
    }

    public function ratings()
    {
        return $this->hasMany('Infogue\Rating');
    }

    public function tags()
    {
        return $this->belongsToMany('Infogue\Tag', 'article_tags')->withTimestamps();
    }

    public function related()
    {

    }

    public function most_popular()
    {

    }

    public function most_commented()
    {

    }
}
