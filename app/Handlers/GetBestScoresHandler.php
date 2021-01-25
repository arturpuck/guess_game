<?php

namespace App\Handlers;

use App\Models\Game;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

Class GetBestScoresHandler {

    public function handle():Response{

         $bestScores = Game::bestScores()->get();
         Storage::disk('local')->put('list.txt', $bestScores->toJson());                             
         return response()->json(['scores' => $bestScores],200);
    }
}