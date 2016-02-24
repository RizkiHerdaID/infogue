<?php

namespace Infogue\Http\Controllers;

use Infogue\Category;
use Infogue\Http\Requests;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the category.
     *
     * @param $category
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        //
    }

}
