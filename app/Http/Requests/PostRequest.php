<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'post_type' => 'required|in:stage,formation',
            'status' => 'in:published,unpublished',
            'start_date' => 'date|after:tomorrow',
            'end_date' => 'date|after:start_date',
            'price' => 'nullable|min:0|regex:/^\d*(\.\d{2})?$/',
            'picture' => 'image|mimes:jpeg,jpg,png',
            'title_image' => 'string|nullable',
        ];
    }
}
