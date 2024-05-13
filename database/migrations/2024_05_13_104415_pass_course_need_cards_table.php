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
        Schema::create('pass_course_need_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('main_line_id')->nullable();
            $table->foreignId('knowledge_card_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_course_need_cards');
    }
};
