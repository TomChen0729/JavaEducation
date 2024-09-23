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
        Schema::table('sec_records', function (Blueprint $table) {
            //
            $table->string('user_answer', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sec_records', function (Blueprint $table) {
            //
            $table->dropColumn('user_answer');
        });
    }
};
