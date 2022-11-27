<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name_en' => 'required|string|max:10|min:3',
            'name_bn' => 'required|string|max:10|min:3',
            'code_en' => 'required|max:6|min:2',
            'code_bn' => 'required|max:6|min:2',
        ];
    }
}
