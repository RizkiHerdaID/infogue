<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
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
     * Store a newly created subcategory in storage.
     *
     * @param Request|SubcategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        $subcategory = new Subcategory();

        $subcategory->fill($request->all());

        if ($subcategory->save()) {
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => Lang::get('alert.subcategory.create', ['subcategory' => $subcategory->subcategory])
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
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

        if ($subcategory->save()) {
            return redirect(route('admin.category.index'))->with([
                'status' => 'success',
                'message' => Lang::get('alert.subcategory.update', ['subcategory' => $subcategory->subcategory])
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
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

        if (!empty(trim($request->input('selected_sub')))) {
            $subcategory_ids = explode(',', $request->input('selected_sub'));

            $delete = Subcategory::whereIn('id', $subcategory_ids)->delete();

            $message = Lang::get('alert.subcategory.delete_all', ['count' => $delete]);
        } else {
            $subcategory = Subcategory::findOrFail($id);

            $message = Lang::get('alert.subcategory.delete', ['subcategory' => $subcategory->subcategory]);

            $delete = $subcategory->delete();
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
