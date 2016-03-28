<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Infogue\Category;
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
        if($sub[0] == 'subcategory'){
            if(isset($sub[1]) && $sub[1] > 0){
                $menu = Subcategory::whereCategoryId($sub[1])->get();
            }
            else{
                $menu = Subcategory::all();
            }
        }
        else if($filter == 'category'){
            $menu = Category::all();
        }
        else{
            $menu = Category::with('subcategories')->get();
        }

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'menus' => $menu
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

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $articles
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

        $articles = $this->subcategory->subcategoryArticle($subcategory->id)->toArray();

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $articles
        ];
    }
}
