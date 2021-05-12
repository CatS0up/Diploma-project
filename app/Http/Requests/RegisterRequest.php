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
            'uid' => 'required|alpha_num|min:3|unique:users|max:70',
            'email' => 'required|email|min:3|unique:users|max:320|confirmed',
            'pwd' => 'required|min:10|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/|confirmed',
            'phone' => 'required|numeric|digits:9|unique:users',
            'firstname' => 'required|regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś]*$/',
            'lastname' => 'required|regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś]*$/',
            'birthday' => 'required|date|before:today',
            'gender' => 'nullable',
            'town' => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ ]*$/',
            'street' => 'nullable',
            'zipcode' => new Zipcode(),
            'building_number' => 'nullable|alpha_num',
            'house_number' => 'required|alpha_num',
            'avatar' => 'nullable|file|image',
            'description' => 'nullable|max:255'
        ];
    }
}
