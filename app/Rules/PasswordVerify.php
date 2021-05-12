<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordVerify implements Rule
{
    private ?string $uid;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?string $uid)
    {
        $this->uid = $uid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::uid($this->uid)
            ->first();

        if ($user)
            return Hash::check($value, $user->pwd);

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Podano nieprawidłowe hasło.';
    }
}
