<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'username' => 'required|max:50|min:3',
            'comment' => 'required|string|max:250|min:3',
            'level_of_nested' => 'required|numeric|between:0,3', //TODO: improve this
            'parent_id' => 'required|numeric', //TODO: improve this
        ];
    }
}
