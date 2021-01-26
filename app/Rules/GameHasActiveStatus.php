<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Game;

class GameHasActiveStatus implements Rule
{
    private ?string $message = null;
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
        $game = Game::find($value);

        if($game === null){
            $this->message = 'the game does not exist';
            return false;
        }

        switch($game->game_status){
            case 'pending':
              return true;
            break;

            case 'won':
              $this->message = 'the game has already been won';
              return false;
            break;

            case 'lost':
                $this->message = 'the game has already been lost';
                return false;
            break;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
