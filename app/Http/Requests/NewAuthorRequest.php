<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewAuthorRequest extends FormRequest
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
            'firstname' => [
                'required',
                'regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś]*$/',
                Rule::unique('authors')->where(fn ($q) =>
                $q->where('lastname', $this->input('lastname')))
            ],

            'lastname' => 'required|regex:/^[A-ZŻŹĆĄŚĘŁÓŃ]+[a-zzżźćńółęąś\-]*$/'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' =>  'Imię nie może być puste.',
            'firstname.regex' =>  'Imię powinno zaczynać się od '
                . 'wielkiej litery oraz może składać się wyłącznie z liter.',
            'firstname.unique' => 'Autor o podanych danych już istnieje.',

            'lastname.required' =>  'Nazwisko nie może być puste.',
            'lastname.regex' =>  'Nazwisko powinno zaczynać się od '
                . 'wielkiej litery oraz może składać się wyłącznie z liter.',
        ];
    }
}
