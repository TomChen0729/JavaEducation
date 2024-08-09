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
        Schema::create('debugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->string('description', 255);
            $table->string('code', 10000);
            $table->integer('wrong_line');
            $table->string('answer', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debugs');
    }
};
