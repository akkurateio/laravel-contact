<?php

namespace Akkurate\LaravelContact\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return preg_match('/0[67]\d{8}/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('A valid mobile phone number must begin with 06 or 07 and contain exactly 10 digits.');
    }
}
