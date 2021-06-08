<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddReviewRequest extends FormRequest
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
            'user_id' => [
                'required',
                'present',
                Rule::unique('reviews')
                    ->where(fn ($q) => $q->where('book_id', $this->input('book_id'))),
                'numeric'
            ],
            'book_id' => 'required|present|numeric',
            'rate'    => 'required|between:1,5',
            'comment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Pole z ID użytkownika nie może byc puste.',
            'user_id.present'  => 'Pole z ID użytkownika nie zostało znalezione.',
            'user_id.unique'   => 'Dodałeś już recenzję tej książki.',
            'user_id.numeric'  => 'Pole akceptuje jedynie wartości numeryczne',

            'book_id.required' => 'Pole z ID książki nie może byc puste.',
            'book_id.present'  => 'Pole z ID book_id nie zostało znalezione.',
            'book_id.numeric'  => 'Pole akceptuje jedynie wartości numeryczne',

            'rate.required'    => 'Proszę podać ocenę.',
            'rate.between'     => 'Ocena powinna być z przedziału od :min do :max.',

            'comment.required' => 'Komentarz nie może być pusty.'
        ];
    }
}
