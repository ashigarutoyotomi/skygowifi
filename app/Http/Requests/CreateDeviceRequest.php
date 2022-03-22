<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class CreateDeviceRequest extends FormRequest
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
            'serial_number'=>'required|string'
            ,
            'address_id'=>'required|integer',
        ];                                                                                                                                  
    }
    public function messages (){
        return [
            'address_id.required'=>'Address id cannot be null',
            'serial_number.required'=>'serial number needed',
        ];
    }
}
