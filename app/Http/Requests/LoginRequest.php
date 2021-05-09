<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'uid' => 'required',
            'pwd' => 'required'
        ];
    }

    function messages()
    {
        return [
            'uid.required' => 'Login nie może być pusty.',
            'pwd.required' => 'Hasło nie może być puste.'
        ];
    }
}
