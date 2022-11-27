<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PocRequest extends FormRequest
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
            'post_office_id' => 'required',
            'poc_code' => 'required|min:2|max:3'
        ];
    }
}
