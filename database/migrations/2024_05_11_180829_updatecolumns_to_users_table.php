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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('birth_year')->nullable()->change();
            $table->foreignId('country_id')->nullable()->change();
            $table->foreignId('pass_familiarity_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('birth_year');
            $table->dropColumn('country_id');
            $table->dropColumn('pass_familiarity_id');
        });
    }
};
