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
        Schema::create('user_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_record_id');
            $table->foreignId('knowledge_card_id');
            $table->time('card_watchtime')->default('00:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_record_details');
    }
};
