<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sec_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->string('gamename', 255);
            $table->text('pre_story');
            $table->text('game_explanation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sec_games');
    }
};
