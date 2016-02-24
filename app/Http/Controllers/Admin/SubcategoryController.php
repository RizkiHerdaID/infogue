<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
     * Store a newly created subcategory in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified subcategory in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified subcategory from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
