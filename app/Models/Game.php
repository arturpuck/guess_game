<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

   protected $fillable = [
    'player_name',
    'from',
    'to',
    'attempts',
    'number',
   ];

   public function getPlayerScoreAttribute(){
       $range = ($this->to - $this->from);
       $probaibilityOfFailingInNAttempts = 1;

       for($I = 0; $I < $this->used_attempts; ++$I){

           $rangeAtCurrentAttempt = $range - $I;
           $probaibilityAtCurrentAttempt = (1 / $rangeAtCurrentAttempt);
           $probaibilityOfFailingInNAttempts *= (1 - $probaibilityAtCurrentAttempt);
       }

       $probabilityOfSuccess = (1 - $probaibilityOfFailingInNAttempts);
       return 1 / $probabilityOfSuccess;
   }

   public function getPlaceAttribute():int{

       $bestScores =  self::select('player_name', 'score', 'id')
                            ->whereNotNull('score')                    
                            ->orderBy('score', 'DESC');
       $place = 0;

       $bestScores->each(function ($item, $key) use (&$place){
               ++$place;

               if($item->id == $this->id){
                 return false;
               }
        });

        return $place;
   }

}
