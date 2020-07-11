<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProductStatusRules;
use App\Rules\OptionSizeRules;
use App\Rules\OptionColorRules;

class ProductStore extends FormRequest
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
            'name'         => ['required', 'string'],
            'code'         => ['required', 'string'],
            'description'  => ['string', 'nullable'],
            'price'        => ['required', 'integer', 'min:1'],
            'stock'        => ['required', 'integer', 'min:0'],
            'photo'        => ['max:3'],
            'photo.*'      => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif'],
            'size'         => ['required', 'string', new OptionSizeRules],
            'color'        => ['required', 'string', new OptionColorRules],
        ];
    }
}
