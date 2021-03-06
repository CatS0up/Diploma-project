<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Zipcode implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^\d{2}-\d{3}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Akceptowalny format xx-xxx.';
    }
}
