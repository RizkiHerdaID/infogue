<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Infogue\Category;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CategoryRequest;
use Infogue\Subcategory;

class CategoryController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Category Controller
     |--------------------------------------------------------------------------
     |
     | This controller is responsible for handling category list and manage
     | the data including creating, updating and deleting data.
     |
     */

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * --------------------------------------------------------------------------
         * Filtering category
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by and sorting
         * method, retrieve the category.
         */

        $filter_by = Input::has('by') ? Input::get('by') : 'timestamp';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $category = new Category();

        $categories = $category->retrieveCategory($filter_by, $filter_sort);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Retrieve subcategory by category id request via AJAX.
     *
     * @param $id
     * @return json
     */
    public function subcategories($id)
    {
        $category = Category::findOrFail($id);

        return $category->subcategories;
    }

    /**
     * Store a newly created category in storage.
     *
     * @param Request|CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();

        $category->fill($request->all());

        if ($category->save()) {
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => Lang::get('alert.category.create', ['category' => $category->category])
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param Request|CategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->fill($request->all());

        if ($category->save()) {
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => Lang::get('alert.category.update', ['category' => $category->category])
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        /*
         * --------------------------------------------------------------------------
         * Delete category
         * --------------------------------------------------------------------------
         * Check if selected variable is not empty so user intends to select multiple
         * rows at once, and prepare the feedback message according the type of
         * deletion action.
         */

        if (!empty(trim($request->input('selected')))) {
            $delete = DB::transaction(function () use ($request) {
                try {
                    $category_ids = explode(',', $request->input('selected'));
                    $delete_subcategory = 0;

                    if ($request->input('selected_sub') != '') {
                        $subcategory_ids = explode(',', $request->input('selected_sub'));

                        $delete_subcategory = Subcategory::whereIn('id', $subcategory_ids)->delete();
                    }

                    $delete = Category::whereIn('id', $category_ids)->delete();

                    return $delete + $delete_subcategory;

                } catch (\Exception $e) {
                    return redirect()->back()
                        ->withErrors(['error' => Lang::get('alert.error.transaction')])
                        ->withInput();
                }
            });

            $message = Lang::get('alert.category.delete_all', ['count' => $delete]);

        } else {
            $category = Category::findOrFail($id);

            $message = Lang::get('alert.category.delete', ['category' => $category->category]);

            $delete = $category->delete();
        }

        if ($delete instanceof RedirectResponse) {
            return $delete;
        }

        if ($delete) {
            return redirect(route('admin.category.index'))->with([
                'status' => 'warning',
                'message' => $message,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
        }
    }
}
