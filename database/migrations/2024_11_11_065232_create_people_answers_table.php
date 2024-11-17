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
        Schema::create('r_people_answers', function (Blueprint $table) {
            $table->string('people_answer_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('question_id')->nullable();
            $table->string('answer')->nullable();
            $table->string('create_by')->nullable();
            $table->string('modified_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_people_answers');
    }
};
