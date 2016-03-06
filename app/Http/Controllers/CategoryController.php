<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Infogue\Article;
use Infogue\Category;
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
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $category_name = str_replace('-',' ', $slug);

        $category = $this->category->where('category', 'like', $category_name)->firstOrFail();

        $articles = $this->category->categoryArticle($category->id);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            $category->category => route('article.category', [$slug]),
        ];

        $next_ref = '#';

        $prev_ref = '#';

        if(Input::get('page', false)){
            return $articles;
        }
        else{
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
        $category_name = str_replace('-',' ', $category_slug);

        $subcategory_name = str_replace('-',' ', $subcategory_slug);

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

        if(Input::get('page', false)){
            return $articles;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

}
