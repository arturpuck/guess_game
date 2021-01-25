<?php

namespace App\Handlers;

use App\Http\Requests\GuessNumberRequest;
use App\Models\Game;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

Class GuessNumberHandler {

    public function handle(GuessNumberRequest $request):Response{

         $game = Game::find($request->get('id'));
        
         ++$game->used_attempts;
         $response = [];

         if($game->number == $request->get('number')){
             $game->game_status = 'won';
             $score = $game->player_score;
             $response['score'] = $score;
             $response['place'] = $game->place;
             $game->score = $score;
         }
         else{

             if($game->used_attempts >= $game->attempts){
                $game->game_status = 'lost';
                $response['number'] = $game->number;
             }
         }

         $game->save();
         $response['status'] = $game->game_status;
         return response()->json($response,200);
    }
}