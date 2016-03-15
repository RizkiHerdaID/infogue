<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Infogue\Category;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Http\Requests\SubcategoryRequest;
use Infogue\Subcategory;

class SubcategoryController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Subcategory Controller
     |--------------------------------------------------------------------------
     |
     | This controller is responsible for handling subcategory management
     | including creating, editing, and deleting data.
     |
     */

    /**
     * Instance variable of Subcategory.
     *
     * @var Category
     */
    private $subcategory;

    /**
     * Create a new subcategory controller instance.
     *
     * @param Subcategory $subcategory
     */
    public function __construct(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * Store a newly created subcategory in storage.
     *
     * @param Request|SubcategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        $subcategory = new Subcategory();

        $subcategory->fill($request->all());

        if($subcategory->save()){
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => 'Subategory <strong>'.$subcategory->subcategory.'</strong> was created',
            ]);
        }

        return redirect()->back()->withErrors();
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
        $subcategory = Subcategory::findOrFail($id);

        $subcategory->fill($request->all());

        if($subcategory->save()){
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => 'Subategory <strong>'.$subcategory->subcategory.'</strong> was updated',
            ]);
        }

        return redirect()->back()->withErrors();
    }

    /**
     * Remove the specified subcategory from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        /*
         * --------------------------------------------------------------------------
         * Delete subcategory
         * --------------------------------------------------------------------------
         * Check if selected variable is not empty so user intends to select multiple
         * rows at once, and prepare the feedback message according the type of
         * deletion action.
         */

        if(!empty(trim($request->input('selected_sub')))){
            $subcategory_ids = explode(',', $request->input('selected_sub'));

            $delete = Subcategory::whereIn('id', $subcategory_ids)->delete();

            $name = count($subcategory_ids).' Subcategories';
        }
        else{
            $subcategory = Subcategory::findOrFail($id);

            $name = $subcategory->subcategory;

            $delete = $subcategory->delete();
        }

        $status = $delete ? 'warning' : 'danger';

        $message = $delete ? '<strong>'.$name.'</strong> was deleted' : 'Something is getting wrong';

        return redirect(route('admin.category.index'))
            ->with('status', $status)
            ->with('message', $message);
    }
}
