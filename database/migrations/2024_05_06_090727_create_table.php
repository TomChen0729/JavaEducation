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
            $table->ipAddress('gender');
            $table->integer('birth_year');
            $table->foreignId('country_id');
            $table->foreignId('pass_familiarity_id');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('name');
            $table->timestamps();
        });

        Schema::create('main_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('knowledge_card_id');
            $table->boolean('enable');
            $table->timestamps();
        });

        Schema::create('pass_familiarities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('country_id');
            $table->integer('levels');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('country_id');
            $table->foreignId('pass_familiarity_id');
            $table->ipAddress('questions');
            $table->timestamps();
        }); 

        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('question_id');
            $table->ipAddress('options');
            $table->timestamps();
        });

        Schema::create('rewriting_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('question_id');
            $table->ipAddress('options');
            $table->timestamps();   
        });
        
        Schema::create('match_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('question_id');
            $table->ipAddress('options');
            $table->timestamps();   
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('question_id');
            $table->ipAddress('answers');
            $table->timestamps();
        });


        Schema::create('knowledge_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('chapter_id');
            $table->foreignId('country_id');
            $table->ipAddress('knowledge_cards_name');
            $table->ipAddress('knowledge_cards_content');
            $table->timestamps();
        });

        Schema::create('chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('name');
            $table->timestamps();
        });

        Schema::create('pass_course_need_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('main_line_id');
            $table->foreignId('knowledge_card_id');
            $table->timestamps();
        });

        Schema::create('pass_course_get_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pass_familiarity_id');
            $table->foreignId('knowledge_card_id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('birth_year');
            $table->dropColumn('country_id');
        });

        Schema::dropIfExists('countries');
        Schema::dropIfExists('main_lines');
        Schema::dropIfExists('pass_familiarities');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('options');
        Schema::dropIfExists('rewriting_options');
        Schema::dropIfExists('match_options');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('knowledge_cards');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('pass_course_need_cards');
        Schema::dropIfExists('pass_course_get_cards');
    }
};
