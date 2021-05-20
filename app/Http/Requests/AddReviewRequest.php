<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'book_id' => 'required',
            'rate' => 'required|between:1,5',
            'title' => 'required|max:255',
            'review' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'rate.required' => 'Proszę podać ocenę.',
            'rate.between' => 'Ocena powinna być z przedziału od :min do :max.',

            'title.required' => 'Tytuł nie może być pusty.',
            'title.max' => 'Tytuł nie może być dłuższy niż :max znaków.',

            'review.required' => 'Treść recenzji nie może być pusta.'
        ];
    }
}
