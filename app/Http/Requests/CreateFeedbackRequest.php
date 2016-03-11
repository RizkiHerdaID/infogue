<?php

namespace Infogue\Http\Requests;

use Infogue\Http\Requests\Request;

class CreateFeedbackRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'message' => 'required|max:5000'
        ];
    }
}
