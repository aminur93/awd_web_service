<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandPreprationSeasionRequest extends FormRequest
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
            'name_en' => 'required|string',
            'name_bn' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date'   => 'required|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }
}
