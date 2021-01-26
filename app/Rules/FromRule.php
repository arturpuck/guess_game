<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FromRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $to)
    {
        $this->to ??= 9;
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
        return ($value > 0) && ($value <= $this->to -2);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The from field must be greater than 0, lesser than or equal `to` - 2";
    }
}
