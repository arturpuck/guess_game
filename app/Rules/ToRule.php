<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ToRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $from)
    {
        $this->from ??= 1;
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
        return ($value > 2) && ($value >= $this->from + 2);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "To field must be  greater than 2, greater than or equal 'from' + 2";
    }
}
