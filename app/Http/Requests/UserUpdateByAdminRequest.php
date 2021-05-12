<?php

namespace App\Http\Requests;

use App\Rules\Zipcode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateByAdminRequest extends FormRequest
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
            'uid' => [
                'required',
                'alpha_num',
                'min:3',
                Rule::unique('users')->ignore($this->route('id')),
                'max:70'
            ],
            'email' => [
                'required',
                'email',
                'min:3',
                Rule::unique('users')->ignore($this->route('id')),
                'max:320'
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:9',
                Rule::unique('users')->ignore($this->route('id'))
            ],
            'role' => 'required',
            'firstname' => 'required|regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś]*$/',
            'lastname' => 'required|regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś]*$/',
            'birthday' => 'required|date|before:today',
            'gender' => 'nullable',
            'town' => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ ]*$/',
            'street' => 'nullable',
            'zipcode' => new Zipcode(),
            'building_number' => 'nullable|alpha_num',
            'house_number' => 'required|alpha_num',
            'description' => 'nullable|max:255'
        ];
    }
}
