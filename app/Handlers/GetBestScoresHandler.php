<?php

namespace App\Handlers;

use App\Models\Game;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

Class GetBestScoresHandler {

    public function handle():Response{

         $bestScores = Game::select('player_name', 'score')
                            ->whereNotNull('score')                    
                            ->limit(30)
                            ->orderBy('score', 'DESC')
                            ->get();

         Storage::disk('local')->put('list.txt', $bestScores->toJson());                             
         return response()->json(['scores' => $bestScores],200);
    }
}