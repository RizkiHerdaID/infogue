<?php

namespace Infogue\Http\Controllers\Api;

use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Subcategory;

class SubcategoryController extends Controller
{
    private $subcategory;

    public function __construct(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * Display a listing of the sub categories.
     *
     * @param $subcategory
     * @return \Illuminate\Http\Response
     */
    public function index($subcategory)
    {
        //
    }
}
