<?php

namespace App\Http\Requests;

use App\Rules\Zipcode;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'uid' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:320', 'unique:users', 'confirmed'],
            'pwd' => ['required', 'string', 'min:10', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:9', 'unique:users'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'gender' => ['nullable'],
            'town' => ['required', 'string'],
            'street' => ['nullable', 'string'],
            'zipcode' => ['required', new Zipcode()],
            'house_number' => ['nullable', 'numeric'],
            'building_number' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string']
        ];
    }
}
