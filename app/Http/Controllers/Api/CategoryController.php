<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Infogue\Category;
use Infogue\Article;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Subcategory;
use Infogue\XMLConstruct;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Category Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling article showing grouped by
    | category and sub category, the categories are given by slug from category
    | title and the article list is result of guessing reverse form of slug.
    |
    */

    /**
     * Instance variable of Category.
     *
     * @var Category
     */
    private $category;

    /**
     * Instance variable of Subcategory.
     *
     * @var Subcategory
     */
    private $subcategory;

    /**
     * Create a new category controller instance.
     *
     * @param Category $category
     * @param Subcategory $subcategory
     */
    public function __construct(Category $category, Subcategory $subcategory)
    {
        $this->category = $category;
        $this->subcategory = $subcategory;
    }

    /**
     * Display a listing of the category.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'merge');

        $sub = explode(':', $filter);
        if ($sub[0] == 'subcategory') {
            if (isset($sub[1]) && $sub[1] > 0) {
                $menu = Subcategory::whereCategoryId($sub[1])->get();
            } else {
                $menu = Subcategory::all();
            }
        } else if ($filter == 'category') {
            $menu = Category::all();
        } else {
            $menu = Category::with('subcategories')->get();
        }

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'categories' => $menu
        ];
    }

    /**
     * Display a listing of the category.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $category_name = str_replace('-', ' ', $slug);

        $category = $this->category->where('category', 'like', $category_name)->firstOrFail();

        $articles = $this->category->categoryArticle($category->id);

        $data = $this->reduceArticleData($articles);

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $data
        ];
    }

    /**
     * Display a listing of the subcategory.
     *
     * @param $category_slug
     * @param $subcategory_slug
     * @return \Illuminate\Http\Response
     */
    public function subcategory($category_slug, $subcategory_slug)
    {
        $category_name = str_replace('-', ' ', $category_slug);

        $subcategory_name = str_replace('-', ' ', $subcategory_slug);

        $category = $this->category->where('category', 'like', $category_name)->firstOrFail();

        $subcategory = $category->subcategories()->where('subcategory', 'like', $subcategory_name)->firstOrFail();

        $articles = $this->subcategory->subcategoryArticle($subcategory->id);

        $data = $this->reduceArticleData($articles);

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $data
        ];
    }

    /**
     * Fetch latest article.
     *
     * @return mixed
     */
    public function latest()
    {
        $article = new Article();
        $latest = $article->latest(false);
        $data = $this->reduceArticleData($latest);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'articles' => $data,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Fetch most popular article.
     *
     * @return mixed
     */
    public function popular()
    {
        $article = new Article();
        $popular = $article->archive('popular', 'view', 'desc');
        $data = $this->reduceArticleData($popular);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'articles' => $data,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Fetch trending article.
     *
     * @return mixed
     */
    public function trending()
    {
        $article = new Article();
        $trending = $article->archive('trending', 'date', 'desc');
        $data = $this->reduceArticleData($trending);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'articles' => $data,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Fetch headline article.
     *
     * @return mixed
     */
    public function headline()
    {
        $article = new Article();
        $headline = $article->archive('headline', 'view', 'desc');
        $data = $this->reduceArticleData($headline);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'articles' => $data,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Fetch random article.
     *
     * @return mixed
     */
    public function random()
    {
        $article = new Article();
        $random = $article->archive('all-data', 'view', 'random');
        $data = $this->reduceArticleData($random);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'articles' => $data,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Reducing article load for better network request speed.
     *
     * @param $articles
     */
    function reduceArticleData($articles)
    {
        $data = collect($articles->toArray());
        $data["data"] = array_map(array($this, "alterArticle"), $data["data"]);
        return $data;
    }

    /**
     * Reduce article data callback function.
     *
     * @param $article
     * @return mixed
     */
    private function alterArticle($article)
    {
        unset($article['contributor_id']);
        unset($article['state']);
        unset($article['name']);
        unset($article['username']);
        unset($article['avatar']);
        unset($article['created_at']);
        unset($article['article_ref']);
        unset($article['contributor_ref']);
        unset($article['avatar_ref']);
        unset($article['category_ref']);
        unset($article['subcategory_ref']);
        unset($article['featured']);
        return $article;
    }
}
