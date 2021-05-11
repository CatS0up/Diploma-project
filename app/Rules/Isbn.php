<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Isbn implements Rule
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
        $length = strlen($value);

        return $length === 10 || $length === 13;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ISBN powinien składać się z 10 lub 13 cyfr.';
    }
}
