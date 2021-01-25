<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('player_name')->default('Unnamed player');
            $table->unsignedBigInteger('from')->default(1);
            $table->unsignedBigInteger('to')->default(9);
            $table->unsignedBigInteger('number');
            $table->unsignedBigInteger('attempts')->default(3);
            $table->unsignedBigInteger('used_attempts')->default(0);
            $table->float('score')->unsigned()->nullable()->default(null);
            $table->enum('game_status', ["pending", "won", "lost"])->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
