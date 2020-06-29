<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryCompaniesRequest extends FormRequest
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
            
            'name' => 'required|max:45',

            'telephone' => 'required|max:11',

            'shipping_cost' => 'required',
        ];
    }

    public function messages()
    {
        return[
            "required" => '必須入力です'
        ];
        
    }
}
