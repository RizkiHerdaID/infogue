<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
     * Create a new category controller instance.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $category = $this->category->findOrFail($id);

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

        if($category->save()){
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => 'Category <strong>'.$category->category.'</strong> was created'
            ]);
        }

        return redirect()->back()->withErrors();
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

        if($category->save()){
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => 'Category <strong>'.$category->category.'</strong> was updated'
            ]);
        }

        return redirect()->back()->withErrors();
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

        if(!empty(trim($request->input('selected')))){
            $category_ids = explode(',', $request->input('selected'));
            $subcategory_ids = [];

            if($request->input('selected_sub') != ''){
                $subcategory_ids = explode(',', $request->input('selected_sub'));

                Subcategory::whereIn('id', $subcategory_ids)->delete();
            }

            $delete = Category::whereIn('id', $category_ids)->delete();

            $name = (count($category_ids) + count($subcategory_ids)).' Categories';
        }
        else{
            $category = Category::findOrFail($id);

            $name = $category->category;

            $delete = $category->delete();
        }

        $status = $delete ? 'warning' : 'danger';

        $message = $delete ? '<strong>'.$name.'</strong> was deleted' : 'Something is getting wrong';

        return redirect(route('admin.category.index'))->with([
            'status' => $status,
            'message' => $message,
        ]);
    }
}