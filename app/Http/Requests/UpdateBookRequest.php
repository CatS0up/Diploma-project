<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
            'cover' => 'nullable|file|image',
            'pdf' => 'nullable|file|mimes:pdf',
            'title' => 'required|regex:/^[a-zA-ZzżźćńółęąśŻŹĆĄŚĘŁÓŃ\- ]*$/',
            'isbn' => ['required', 'numeric', new Isbn(), Rule::unique('books')->ignore($this->route('id'))],
            'publisher' => 'required',
            'authors' => 'required',
            'genres' => 'required',
            'publishing_date' => 'required|date|before_or_equal:today',
            'description' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'cover.file' => 'Wysyłanie pliku nie powiodło się.',
            'cover.image' => 'Okładka musi być plikiem graficznym.',

            'pdf.file' => 'Wysyłanie pliku nie powiodło się.',
            'pdf.mimes' => 'Plik musi być w formacie .pdf.',

            'reset_cover.required' => 'Wybierz opcję resetowania okładki.',

            'title.required' => 'Tytuł nie może być pusty.',
            'title.regex' => 'Tytuł może składać się z liter, spacji oraz zawierać znak "-".',

            'isbn.required' => 'Numer ISBN nie może być pusty.',
            'isbn.numeric' => 'Pole akceptuje jedynie wartości numeryczne.',
            'isbn.unique' => 'Numer ISBN jest przypisany do innej książki.',

            'publisher.required' => 'Nazwa wydawcy nie może być pusta.',

            'authors.required' => 'Dane autora nie mogą być puste.',

            'genres.required' => 'Nazwa gatunku nie może być pusta.',

            'publishing_date.required' => 'Data wydania nie może być pusta.',
            'publishing_date.date' => 'Proszę wprowadzić poprawną datę.',
            'publishing_date.before_or_equal' => 'Proszę wprowadzić wcześniejszą datę.',

            'description.required' => 'Ksiązka musi posiadać opis.'

        ];
    }
}
