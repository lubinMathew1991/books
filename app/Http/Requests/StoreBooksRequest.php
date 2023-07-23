<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBooksRequest extends FormRequest
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
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required',
            'publication_year' => 'integer|min:1|max:' . date("Y"),
            'cover_image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
