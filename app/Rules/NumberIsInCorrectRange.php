<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Game;

class NumberIsInCorrectRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $id)
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
       return Game::where('id', $this->id)
                   ->where('from', '<=', intval($value))
                   ->where('to', '>=', intval($value))
                   ->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The number must be between selected range';
    }
}
