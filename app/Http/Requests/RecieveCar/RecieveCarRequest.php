<?php

namespace App\Http\Requests\RecieveCar;

use Illuminate\Foundation\Http\FormRequest;

class RecieveCarRequest extends FormRequest
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
            'customer_id'=> 'required|exists:users,id',
            'carmodel_id'=> 'required|exists:car_models,id',
            'customerlocation_id'=> 'required|exists:districts,id',
            'carlocation_id'=> 'required|exists:districts,id',
        ];

    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Please Choose Customer',
            'carmodel_id.required' => 'Please Choose Car Model',
            'customerlocation_id.required' => 'Please Choose Customer Location',
            'carlocation_id.required' => 'Please Choose Car Location',
        ];
    }
}
