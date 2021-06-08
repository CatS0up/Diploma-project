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
            'name' => 'required|unique:genres|max:70'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Gatunek nie może być pusty.',
            'name.unique'   => 'Taki gatunek juz istnieje.',
            'name.max'      => 'Maksymalna długość nazyw gatunku :max.'
        ];
    }
}
