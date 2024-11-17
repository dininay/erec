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
        Schema::create('r_course', function (Blueprint $table) {
            $table->string('course_id')->nullable();
            $table->string('cat_id')->nullable();
            $table->string('course_type')->nullable();
            $table->string('access_type')->nullable();
            $table->string('publish_date')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_time')->nullable();
            $table->string('slug')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('r_course');
    }
};
