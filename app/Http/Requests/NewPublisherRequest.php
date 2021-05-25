<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPublisherRequest extends FormRequest
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
            'name' => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ0-9\- ]+$/'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa wydawcy nie może być pusta.',
            'name.regex' => 'Nazwa wydawcy może składać się z liter, spacji, - oraz cyfr/'
        ];
    }
}
