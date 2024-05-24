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
        Schema::table('knowledge_cards', function (Blueprint $table) {
            // 宣告欄位
            $table->foreignId('card_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('knowledge_cards', function (Blueprint $table) {
            // 再刪除欄位
            $table->dropColumn('card_type');
        });
    }
};
