<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateAffiliateRequest extends FormRequest
{
    /**
     * Determine if the Affiliate is authorized to make this request.
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password'=>['required','string',Password::min(8)->letters()->mixedCase()->numbers()],
        ];
    }
    public function messages (){
        return [
            'password.required'=>'password cannot be null',
            'first_name.required'=>'name needed',
            'email.required'=>'required email',
            'password.letters'=>'password must contain letters ',
            'password.numbers'=>'password must have numbers also',
            'password.mixedCase'=>'password must have at least 1 lowercase and uppercase letter'
        ];
    }
}
