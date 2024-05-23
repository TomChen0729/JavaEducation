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
            $table->foreignId('country_id')->nullable();
            $table->ipAddress('name')->nullable();
            $table->ipAddress('content')->nullable();
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
