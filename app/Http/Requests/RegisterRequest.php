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
            'uid'          => 'required|alpha_num|min:3|unique:users|max:70',
            'email'        => 'required|email|min:3|unique:users|max:320|confirmed',
            'pwd'          => 'required|min:10|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{10,}$/|confirmed',
            'phone'        => 'required|numeric|digits:9|unique:users',
            'firstname'    => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]*$/',
            'lastname'     => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\-]*$/',
            'birthday'     => 'required|date|before:today',
            'gender'       => 'nullable',
            'town'         => 'required|regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\- ]*$/',
            'street'       => 'nullable',
            'zipcode'      => new Zipcode(),
            'local_number' => ['required', 'regex:/^([A-Za-z0-9]+)|([A-Za-z0-9]+\/[A-Za-z0-9]+)$/'],
            'avatar'       => 'nullable|file|image',
            'description'  => 'nullable|max:255'
        ];
    }

    public function messages()
    {
        return [
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
            'pwd.min'               => 'Minimalna długość wynosi :min.',
            'pwd.regex'             => 'Hasło powinno zawierać min. 1 małą, 1 wielką literę, 1 cyfrę oraz 1 znak specjalny.',

            'phone.required'        => 'Numer telefonu nie może być pusty.',
            'phone.numeric'         => 'Pole akceptuje jedynie wartości numeryczne.',
            'phone.digits'          => 'Numer telefonu powinien składać się dokładnie z 9 znaków.',
            'phone.unique'          => 'Podany numer jest już przypisany do innego użytkownika.',

            'firstname.required'    => 'Imię nie może być puste.',
            'firstname.regex'       => 'Imię może składać się.',

            'lastname.required'     => 'Nazwisko nie może być puste.',
            'lastname.regex'        => 'Nazwisko powinno zaczynać się od wielkiej litery oraz może składać się wyłącznie z liter.',

            'birthday.required'     => 'Data urodzenia nie może byc pusta.',
            'birthday.date'         => 'Proszę wprowadzić poprawną datę.',
            'birthday.before'       => 'Proszę wprowadzić wcześniejszą datę.',

            'town.required'         => 'Miasto nie może być puste.',
            'town.regex'            => 'Nazwa miasta może składać się jedynie z liter i spacji.',

            'local_number.required' => 'Numer lokalu nie może być pusty.',
            'local_number.regex'    => 'Numer lokalu powinien być zgodny z formatem xx/xx lub xx.',

            'avatar.file'           => 'Wysyłanie pliku nie powiodło się.',
            'avatar.image'          => 'Avatar musi być plikiem graficznym.',

            'description.max'       => 'Opis może składać się maksymalnie z :max znaków.'
        ];
    }
}
