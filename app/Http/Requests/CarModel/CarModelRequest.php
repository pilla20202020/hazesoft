<?php

namespace App\Http\Requests\CarModel;

use Illuminate\Foundation\Http\FormRequest;

class CarModelRequest extends FormRequest
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
            'car_id'=> 'required|exists:cars,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'car_id.required' => 'Please Select Car',
        ];
    }
}
