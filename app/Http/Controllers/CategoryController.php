<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Infogue\Category;
use Infogue\Http\Requests;
use Infogue\Subcategory;

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
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating article by category
         * --------------------------------------------------------------------------
         * Reverse category by slug form into plain name and select article by that
         * name, also construct breadcrumb stack, because we implement lazy
         * pagination via ajax so return json when 'page' variable exist.
         */

        $categoryName = str_replace('-', ' ', $slug);

        $category = $this->category->where('category', 'like', $categoryName)->firstOrFail();

        $articles = $this->category->categoryArticle($category->id);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            $category->category => route('article.category', [$slug]),
        ];

        $next_ref = '#';

        $prev_ref = '#';

        if (Input::get('page', false)) {
            return $articles;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
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
        /*
         * --------------------------------------------------------------------------
         * Populating article by sub category
         * --------------------------------------------------------------------------
         * Article is retrieved by category then from category select subcategory,
         * because some categories maybe have similar subcategory name and resulting
         * same slug, they return view or json depend on 'page' existences.
         */

        $category_name = str_replace('-', ' ', $category_slug);

        $subcategory_name = str_replace('-', ' ', $subcategory_slug);

        $category = $this->category->where('category', 'like', $category_name)->firstOrFail();

        $subcategory = $category->subcategories()->where('subcategory', 'like', $subcategory_name)->firstOrFail();

        $articles = $this->subcategory->subcategoryArticle($subcategory->id);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            $category->category => route('article.category', [$category_slug]),
            $subcategory->subcategory => route('article.subcategory', [$category_slug, $subcategory_slug]),
        ];

        $next_ref = '#';

        $prev_ref = '#';

        if (Input::get('page', false)) {
            return $articles;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Retrieve subcategory by category id request via AJAX.
     *
     * @param $id
     * @return json
     */
    public function subcategories($id)
    {
        $category = $this->category->findOrFail($id);

        return $category->subcategories;
    }
}