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
        Schema::dropIfExists('question_status');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('question_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('question_id');
            $table->boolean('status');
            $table->timestamps();
        });
    }
};
