<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use App\Models\Game;

class GameIsValid implements Rule
{
    /**
     * Create a new rule instance.
     *
    
     * @return void
     */

    private string $message = '';

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
        $game = Game::where('id', intval($value))->get()->first();

        try{
            if($game){
           
                $gameIsActive = Game::where('id', intval($value))
                     ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())
                     ->exists();
    
                if(!$gameIsActive){
                    throw new \Exception('game is outdated');
                }

                switch($game->game_status){
                    case 'pending':
                      return true;
                    break;
        
                    case 'won':
                        throw new \Exception('the game has already been won');
                    break;
        
                    case 'lost':
                        throw new \Exception('the game has already been lost');
                    break;
                }
             
             }
             else{
                throw new \Exception('game does not exists');
             }
        }catch(\Exception $exception){
            $this->message = $exception->getMessage();
            return false;
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
