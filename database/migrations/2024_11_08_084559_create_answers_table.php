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
        Schema::create('r_answer', function (Blueprint $table) {
            $table->integer('answer_id')->autoIncrement();
            $table->string('question_id')->nullable();
            $table->string('answer_name')->nullable();
            $table->string('is_correct')->nullable();
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
        Schema::dropIfExists('r_answer');
    }
};
