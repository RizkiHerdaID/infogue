<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    public function articles()
    {
        return $this->hasManyThrough('Infogue\Article', 'App\Subcategory', 'category_id', 'label');
    }

    public function subcategories()
    {
        return $this->hasMany('Infogue\Subcategory');
    }
}
