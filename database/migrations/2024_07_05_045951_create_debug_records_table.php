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
        Schema::create('debug_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('debug_id'); // debug題目表的id
            $table->time('watchtime')->default('00:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debug_records');
    }
};
