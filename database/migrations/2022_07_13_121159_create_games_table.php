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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_team');
            $table->unsignedBigInteger('opponent');
            $table->string('location');
            $table->timestamp('game_time');
            $table->tinyInteger('is_active')->default(false);
            $table->tinyInteger('is_practice')->default(false);
            $table->timestamps();
        });

        Schema::table('games', function($table) {
            $table->foreign('home_team')->references('id')->on('teams');
            $table->foreign('opponent')->references('id')->on('teams');
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
};
