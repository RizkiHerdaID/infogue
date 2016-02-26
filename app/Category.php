<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    private $article;

    public function category_article($id)
    {
        $this->article = new Article();

        $articles = $this->article->preArticleQuery()
            ->where('articles.status', 'published')
            ->where('category_id', $id)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(9);

        return $this->article->preArticleModifier($articles);
    }

    public function articles()
    {
        return $this->hasManyThrough('Infogue\Article', 'Infogue\Subcategory');
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
            ->groupBy('categories.id')
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
