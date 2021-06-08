<?php

namespace App\Http\Requests;

use App\Rules\PasswordVerify;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'avatar'       => 'nullable|file|image',
            'reset_avatar' => 'required',
            'uid' => [
                'required',
                'alpha_num',
                'min:3',
                Rule::unique('users')->ignore($this->input('user_id')),
                'max:70'
            ],
            'email' => [
                'required',
                'email',
                'min:3',
                Rule::unique('users')->ignore($this->input('user_id')),
                'max:320'
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:9',
                Rule::unique('users')->ignore($this->input('user_id'))
            ],
            'pwd'         => ['required', new PasswordVerify($this->route('uid'))],
            'new_pwd'     => 'nullable|min:10|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{10,}$/|confirmed',
            'description' => 'nullable|max:255'
        ];
    }

    public function messages()
    {
        return [
            'avatar.file'           => 'Wysyłanie pliku nie powiodło się.',
            'avatar.image'          => 'Avatar musi być plikiem graficznym.',

            'reset_avatar.required' => 'Wybierz opcję resetowania avatara.',

            'uid.required'          => 'Login nie może być pusty.',
            'uid.alpha_num'         => 'Login może się składać jedynie z liter i cyfr.',
            'uid.unique'            => 'Podany login jest już wykorzystywany.',
            'uid.min'               => 'Minimalna długość wynosi :min.',
            'uid.max'               => 'Maksymalna długość wynosi :max.',

            'email.required'        => 'E-mail nie może być pusty.',
            'email.email'           => 'Proszę wprowadzić poprawny adres e-mail.',
            'email.min'             => 'Minimalna długość wynosi :min.',
            'email.unique'          => 'Podany e-mail jest już wykorzystywany',
            'email.max'             => 'Maksymalna długość wynosi :max',
            'email.confirmed'       => 'Podane adresy e-mail nie zgadzają się.',

            'pwd.required'          => 'Hasło nie może być puste.',

            'new_pwd.min'           => 'Minimalna długość wynosi :min.',
            'new_pwd.regex'         => 'Hasło powinno zawierać min. 1 małą, 1 wielką literę, 1 cyfrę oraz 1 znak specjalny.',
            'new_pwd.confirmed'     => 'Nowe hasło wymaga potwierdzenia.',

            'phone.required'        => 'Numer telefonu nie może być pusty.',
            'phone.numeric'         => 'Pole akceptuje jedynie wartości numeryczne.',
            'phone.digits'          => 'Numer telefonu powinien składać się dokładnie z 9 znaków.',
            'phone.unique'          => 'Podany numer jest już przypisany do innego użytkownika.',

            'description.max'       => 'Opis może składać się maksymalnie z :max znaków.'
        ];
    }
}
