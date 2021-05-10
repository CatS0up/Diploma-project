<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;

class NewBookRequest extends FormRequest
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
            'pdf' => 'required|file|mimes:pdf',
            'title' => 'required|regex:/^[a-zA-Z ]*$/',
            'isbn' => ['required', 'numeric', new Isbn()],
            'publisher' => 'required|regex:/^[a-zA-Z0-9 ]*$/',
            'authors' => 'required|regex:/^[^,\s][^\,]*[^,\s]*$/',
            'genres' => 'required|regex:/^[^,\s][^\,]*[^,\s]*$/',
            'publishing_date' => 'required|date',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cover.file' => 'Wysyłanie pliku nie powiodło się.',
            'cover.image' => 'Okładka musi być plikiem graicznym.',

            'pdf.required' => 'Każda książka musi posiadać swój plik.',
            'pdf.file' => 'Wysyłanie pliku nie powiodło się.',
            'pdf.mimes' => 'Pole akceptuje jedynie pliki w formacie *.pdf.',

            'title.required' => 'Tytuł nie może być pusty.',
            'title.regex' => 'Pole akceptuje jedynie litery oddzielone spacją.',

            'isbn.required' => 'ISBN nie może być pusty.',
            'isbn.numeric' => 'Pole akceptuje jedynie wartości liczbowe.',

            'publisher.required' => 'Wydawca nie może być pusty.',
            'publisher.regex' => 'Pole akceptuje jedynie cyfry, małe/wielkie litery oraz spacje.',

            'authors.required' => 'Pole autora nie może być puste.',
            'authors.regex' => 'Lista autorów powinna być oddzielona przecinkami.',

            'genres.required' => 'Gatunek nie może być pusty.',
            'genres.regex' => 'Lista gatunków powinna być oddzielona przecinkami.',

            'publishing_date.required' => 'Data wydania nie może być pusta.',
            'publishing_date.date' => 'Pole musi być datą.',

            'description.required' => 'Książka wymaga opisu.'
        ];
    }
}
