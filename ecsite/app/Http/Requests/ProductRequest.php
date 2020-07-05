<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'keyword' => 'required|max:1',

            'amount_from' => 'required|integer|between:0,500',

            'amount_to' => 'required|integer|between:500,10000',
        ];

    }

    public function messages()
    {
        return[
            'keyword.required' => 'もう1度入力して下さい'
        ];
    }
}
