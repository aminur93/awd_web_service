<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnionRequest extends FormRequest
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
            'village_id' => 'required',
            'name_en' => 'required|string|max:15|min:2',
            'name_bn' => 'required|string|max:15|min:2',
        ];
    }
}
