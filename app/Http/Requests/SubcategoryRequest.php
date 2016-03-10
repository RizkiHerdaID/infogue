<?php

namespace Infogue\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Infogue\Http\Requests\Request;

class SubcategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'subcategory' => 'required|max:20',
            'label' => 'required|max:20',
            'description' => 'required|max:50',
        ];
    }
}
