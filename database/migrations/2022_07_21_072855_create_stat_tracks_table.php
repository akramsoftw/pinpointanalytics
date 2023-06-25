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
        Schema::create('stat_tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('player_id');
            $table->smallInteger('points')->default(0);
            $table->smallInteger('def_reb')->default(0);
            $table->smallInteger('off_reb')->default(0);
            $table->smallInteger('assist')->default(0);
            $table->smallInteger('turnover')->default(0);
            $table->smallInteger('block')->default(0);
            $table->smallInteger('steal')->default(0);
            $table->smallInteger('possession')->default(0);
            $table->smallInteger('foul')->default(0);
            $table->smallInteger('loose_ball')->default(0);
            $table->smallInteger('charge')->default(0);
            $table->smallInteger('box_out')->default(0);
            $table->smallInteger('hockey_assist_extra_pass')->default(0);
            $table->smallInteger('pass_leading_to_foul')->default(0);
            $table->smallInteger('screen_assist')->default(0);
            $table->smallInteger('tap_back')->default(0);
            $table->smallInteger('rim_run_sprint_the_floor')->default(0);
            $table->smallInteger('off_paint_touch')->default(0);
            $table->smallInteger('deflection')->default(0);
            $table->smallInteger('wall_up')->default(0);
            $table->smallInteger('contest_2')->default(0);
            $table->smallInteger('contest_3')->default(0);
            $table->smallInteger('missed_rotation')->default(0);
            $table->smallInteger('def_paint_touch')->default(0);
            $table->timestamps();
        });

        Schema::table('stat_tracks', function($table) {
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stat_tracks');
    }
};
