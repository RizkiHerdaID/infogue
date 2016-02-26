<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    public function articles()
    {
        return $this->hasManyThrough('Infogue\Article', 'Infogue\Subcategory', 'category_id', 'subcategory_id');
    }

    public function subcategories()
    {
        return $this->hasMany('Infogue\Subcategory');
    }

    public function featured()
    {
        $top_categories = $this->select(DB::raw('categories.id, SUM(view) AS total_view'))
            ->join('subcategories', 'category_id', '=', 'categories.id')
            ->join('articles', 'subcategory_id','=', 'subcategories.id')
            ->where('status', 'published')
            ->groupBy('articles.id')
            ->orderBy('total_view', 'desc')
            ->take('6')
            ->get();

        $featured_categories = array();

        foreach($top_categories as $category):

            $collection = $category->articles()
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            array_push($featured_categories, $collection);

        endforeach;

        return $featured_categories;
    }
}
