<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Game;
use Carbon\Carbon;

class GameIDIsNotToOld implements Rule
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
       
        return Game::where('id', intval($value))
                    ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())
                    ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This game is outdated';
    }
}
