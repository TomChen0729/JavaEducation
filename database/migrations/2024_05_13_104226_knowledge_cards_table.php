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
        Schema::create('knowledge_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('chapter_id')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->ipAddress('knowledge_cards_name')->nullable();
            $table->ipAddress('knowledge_cards_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_cards');
    }
};
