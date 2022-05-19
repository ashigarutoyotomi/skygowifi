<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDeviceCsvRequest extends FormRequest
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
            'csv' =>"required|file",
            'address_id'=>'required|integer',
        ]  ;
    }
    public function messages()
    {
        return [
            'address_id.required'=>'Address id cannot be null',
            'csv.required'=>'csv file is required to upload',
        ];
    }
}
