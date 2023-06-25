<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shot_charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('player_id');
            $table->tinyInteger('chart_section')->default(0);
            $table->smallInteger('attempted')->default(0);
            $table->tinyInteger('is_free_throw')->default(0);
            $table->smallInteger('made')->default(0);
            $table->smallInteger('points')->default(0);
            $table->smallInteger('dribbles')->default(0);
            $table->string('shot_clock', 10)->nullable();
            $table->string('play', 100)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });

        Schema::table('shot_charts', function($table) {
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shot_charts');
    }
};
