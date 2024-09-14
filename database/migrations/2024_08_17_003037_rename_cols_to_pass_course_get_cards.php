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
        Schema::table('pass_course_get_cards', function (Blueprint $table) {
            //
            $table->renameColumn('levels', 'secGameID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pass_course_get_cards', function (Blueprint $table) {
            //
            $table->renameColumn('secGameID', 'levels');
        });
    }
};
