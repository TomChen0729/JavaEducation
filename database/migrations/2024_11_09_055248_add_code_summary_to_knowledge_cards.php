<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('knowledge_cards', function (Blueprint $table) {
            //
            $table->text('code');
            $table->string('summary', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('knowledge_cards', function (Blueprint $table) {
            //
            $table->dropColumn(['code', 'summary']);
        });
    }
};