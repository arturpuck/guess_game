<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateNewGameRequest;
use App\Http\Requests\GuessNumberRequest;
use App\Handlers\CreateGameHandler;
use App\Handlers\GuessNumberHandler;
use App\Handlers\GetBestScoresHandler;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    public function createNew(CreateNewGameRequest $request, CreateGameHandler $handler):Response{
         return $handler->handle($request);
    }

    public function guessNumber(GuessNumberRequest $request, GuessNumberHandler $handler):Response{
        return $handler->handle($request);
    }

    public function showScores(GetBestScoresHandler $handler){
        return $handler->handle();
    }

}
