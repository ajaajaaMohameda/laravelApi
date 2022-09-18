<?php

namespace App\Http\Requests;

use App\Rules\integerArray;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'body' => ['string', 'required'],
            'user_ids' => [
                'array',
                'required',
                new integerArray()
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'use a string',
            'body.required' => 'Please enter a body' 
        ];
    }
}
