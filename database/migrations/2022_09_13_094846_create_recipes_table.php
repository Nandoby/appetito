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
        Schema::create('recipes', function (Blueprint $table) {

            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->integer('time'); // in seconds
            $table->timestamps();

            $table->foreignId('category_id')->constrained();
            $table->foreignId('difficulty_id')->constrained();
            $table->foreignId('season_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
