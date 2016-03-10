<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    private $article;

    public function categoryArticle($id)
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

    public function retrieveCategory($by, $sort)
    {
        $categories = $this->select(DB::raw('categories.*, subcategories.subcategory, IFNULL(SUM(article_total), 0) AS article_total, IFNULL(SUM(view_total), 0) AS view_total, IFNULL(CEIL(AVG(rating_total)), 0) AS rating_total, IFNULL(COUNT(subcategories.id), 0) AS subcategory_total'))
            ->leftJoin('subcategories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoin(DB::raw("(SELECT subcategory_id, COUNT(*) AS article_total, SUM(view) AS view_total FROM articles GROUP BY subcategory_id) articles"), 'articles.subcategory_id', '=', 'subcategories.id')
            ->leftJoin(DB::raw("(SELECT subcategory_id, AVG(rate) AS rating_total FROM articles INNER JOIN ratings ON articles.id = ratings.article_id GROUP BY subcategory_id) ratings"), 'ratings.subcategory_id', '=', 'subcategories.id')
            ->groupBy('categories.id');

        if($by == 'timestamp'){
            $categories->orderBy('created_at', $sort);
        }
        else if($by == 'title'){
            $categories->orderBy('category', $sort);
            return $categories->with(['subcategories' => function($query) use($sort){
                $query->orderBy('subcategory', $sort);
            }])->paginate(10);
        }
        else if($by == 'sub'){
            $categories->orderBy('subcategory_total', $sort);
        }
        else if($by == 'article'){
            $categories->orderBy('article_total', $sort);
        }
        else if($by == 'view'){
            $categories->orderBy('view_total', $sort);
        }
        else if($by == 'popularity'){
            $categories->orderBy('rating_total', $sort);
        }

        return $categories->with('subcategories')->paginate(10);
    }
}
