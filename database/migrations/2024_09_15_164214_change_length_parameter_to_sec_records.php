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
            $table->string('parameter', 10000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sec_records', function (Blueprint $table) {
            //
            $table->string('parameter')->change();
        });
    }
};
