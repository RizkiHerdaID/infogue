<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category', 'description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Retrieve articles by category.
     *
     * @param $id
     * @return mixed
     */
    public function categoryArticle($id)
    {
        $article = new Article();

        $articles = $article->preArticleQuery()
            ->where('articles.status', 'published')
            ->where('category_id', $id)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(12);

        return $article->preArticleModifier($articles);
    }

    /**
     * Many-to-many relationship, retrieve articles through sub article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function articles()
    {
        return $this->hasManyThrough('Infogue\Article', 'Infogue\Subcategory');
    }

    /**
     * On-to-many relationship, retrieve subcategories by category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany('Infogue\Subcategory');
    }

    /**
     * Retrieve top featured article by category in homepage.
     *
     * @return array
     */
    public function featured()
    {
        /*
         * --------------------------------------------------------------------------
         * Top category
         * --------------------------------------------------------------------------
         * Select the most viewed category by accumulating view total in all article
         * on that category then take 6 from them.
         */

        $top_categories = $this->select(DB::raw('categories.id, SUM(view) AS total_view'))
            ->join('subcategories', 'category_id', '=', 'categories.id')
            ->join('articles', 'subcategory_id', '=', 'subcategories.id')
            ->where('status', 'published')
            ->groupBy('categories.id')
            ->orderBy('total_view', 'desc')
            ->take('6')
            ->get();

        /*
         * --------------------------------------------------------------------------
         * Find latest article
         * --------------------------------------------------------------------------
         * Select latest article in each popular category and put it on array as
         * featured content and show it on homepage.
         */

        $featured_categories = array();

        foreach ($top_categories as $category):

            $collection = $category->articles()
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            array_push($featured_categories, $collection);

        endforeach;

        return $featured_categories;
    }

    /**
     * Retrieve all categories with sorting use in admin page.
     *
     * @param $by
     * @param $sort
     * @return mixed
     */
    public function retrieveCategory($by, $sort)
    {
        /*
         * --------------------------------------------------------------------------
         * Populate category through article
         * --------------------------------------------------------------------------
         * Select category with all accessor and accumulate some data like article
         * total, rating total, view total and subcategory total, each aggregate
         * function must be selected in sub query.
         */

        $categories = $this->select(DB::raw('categories.*, subcategories.subcategory, IFNULL(SUM(article_total), 0) AS article_total, IFNULL(SUM(view_total), 0) AS view_total, IFNULL(CEIL(AVG(rating_total)), 0) AS rating_total, IFNULL(COUNT(subcategories.id), 0) AS subcategory_total'))
            ->leftJoin('subcategories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoin(DB::raw("(SELECT subcategory_id, COUNT(*) AS article_total, SUM(view) AS view_total FROM articles GROUP BY subcategory_id) articles"), 'articles.subcategory_id', '=', 'subcategories.id')
            ->leftJoin(DB::raw("(SELECT subcategory_id, AVG(rate) AS rating_total FROM articles INNER JOIN ratings ON articles.id = ratings.article_id GROUP BY subcategory_id) ratings"), 'ratings.subcategory_id', '=', 'subcategories.id')
            ->groupBy('categories.id');

        /*
         * --------------------------------------------------------------------------
         * Sorting data
         * --------------------------------------------------------------------------
         * Sort data by date, title, sub total, article total, view total, popularity
         * and rating total in ascending or descending.
         */

        if ($by == 'timestamp') {
            $categories->orderBy('created_at', $sort);
        } else if ($by == 'title') {
            $categories->orderBy('category', $sort);
            return $categories->with(['subcategories' => function ($query) use ($sort) {
                $query->orderBy('subcategory', $sort);
            }])->paginate(10);
        } else if ($by == 'sub') {
            $categories->orderBy('subcategory_total', $sort);
        } else if ($by == 'article') {
            $categories->orderBy('article_total', $sort);
        } else if ($by == 'view') {
            $categories->orderBy('view_total', $sort);
        } else if ($by == 'popularity') {
            $categories->orderBy('rating_total', $sort);
        }

        return $categories->with('subcategories')->paginate(10);
    }
}