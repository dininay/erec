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
        Schema::create('r_people', function (Blueprint $table) {
            $table->string('people_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('apply_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('r_people');
    }
};
