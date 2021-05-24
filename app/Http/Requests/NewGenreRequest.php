<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewGenreRequest extends FormRequest
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
            'genre' => 'required|unique:genres,name|max:70'
        ];
    }

    public function messages()
    {
        return [
            'genre.required' => 'Gatunek nie może być pusty.',
            'genre.unique' => 'Taki gatunek juz istnieje.',
            'genre.max' => 'Maksymalna długość nazyw gatunku :max.'
        ];
    }
}
