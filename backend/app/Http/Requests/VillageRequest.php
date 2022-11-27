<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VillageRequest extends FormRequest
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
            'thana_id' => 'required',
            'name_en' => 'required|string|max:10|min:2',
            'name_bn' => 'required|string|max:10|min:2',
            'code_en' => 'required|max:10|min:2',
            'code_bn' => 'required|max:10|min:2',
        ];
    }
}
