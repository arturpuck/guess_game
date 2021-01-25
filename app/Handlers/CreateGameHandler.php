<?php

namespace App\Handlers;

use App\Http\Requests\CreateNewGameRequest;
use App\Models\Game;
use Symfony\Component\HttpFoundation\Response;

Class CreateGameHandler {

    public function handle(CreateNewGameRequest $request):Response{
         $data = array_merge($request->all(), ['number' => rand($request->get('from'), $request->get('to'))]);
         $game = Game::create($data);
         return response()->json(['id' => strval($game->id)],200);
    }
}