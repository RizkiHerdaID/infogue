<?php

namespace Infogue\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Infogue\Http\Requests\Request;

class CreateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() || Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:70',
            'slug' => 'required|alpha_dash|max:100|unique:articles,slug',
            'type' => 'required|in:standard,gallery,video',
            'category' => 'required',
            'subcategory' => 'required',
            'tags' => 'required|max:200',
            'featured' => 'required|mimes:jpg,jpeg,gif,png|max:1000',
            'content' => 'required',
            'excerpt' => 'max:300',
            'status' => 'required|in:pending,draft,published,reject',
        ];
    }
}
