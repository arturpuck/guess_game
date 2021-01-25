<?php

namespace App\Handlers;

use App\Http\Requests\CreateNewGameRequest;
use App\Models\Game;
use Symfony\Component\HttpFoundation\Response;

Class CreateGameHandler {

    public function handle(CreateNewGameRequest $request):Response{
         $from = $request->get('from') ?? 1;
         $to = $request->get('from') ?? 9;
         $data = array_merge($request->all(), ['number' => rand($from,$to)]);
         $game = Game::create($data);
         return response()->json(['id' => strval($game->id)],200);
    }
}