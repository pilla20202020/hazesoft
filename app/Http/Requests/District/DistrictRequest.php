<?php

namespace App\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
            //
            'title'=> 'required|string|',
            'state_id'=> 'required|exists:states,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'stat_id.required' => 'Please Select State',
        ];
    }
}
