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
        Schema::create('sec_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sec_Qid');
            $table->time('time')->default('00:00:00');
            $table->string('parameter');
            $table->enum('status', ['watched', 'false', 'true', 'watch_again'])->default('watched');
            $table->integer('counter')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sec_records');
    }
};
