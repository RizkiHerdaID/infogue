<?php

namespace Infogue\Http\Controllers\Api;

use Infogue\Category;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Subcategory;

class CategoryController extends Controller
{
    private $category;

    private $subcategory;

    public function __construct(Category $category, Subcategory $subcategory)
    {
        $this->category = $category;
        $this->subcategory = $subcategory;
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Category::with('subcategories')->get();

        return $menu;
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

        return $articles;
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

        return $articles;
    }
}
