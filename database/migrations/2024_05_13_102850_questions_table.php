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
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('country_id')->nullable();
            $table->foreignId('knowledge_card_id')->nullable();
            $table->char('gametype')->nullable();
            $table->char('describe')->nullable();
            $table->char('questions',length: 200)->nullable();
            $table->char('answer',length:200)->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
