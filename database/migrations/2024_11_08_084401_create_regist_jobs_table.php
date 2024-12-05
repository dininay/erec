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
        Schema::create('r_registjob', function (Blueprint $table) {
            $table->string('reg_id')->nullable();
            $table->string('reg_name')->nullable();
            $table->string('reg_code')->nullable();
            $table->string('job_title')->nullable();
            $table->string('div_id')->nullable();
            $table->string('dept_id')->nullable();
            $table->string('workloc_id')->nullable();
            $table->string('specwork_id')->nullable();
            $table->string('job_respons')->nullable();
            $table->string('type_id')->nullable();
            $table->string('level_id')->nullable();
            $table->string('vacancy_number')->nullable();
            $table->string('job_desc')->nullable();
            $table->string('qualification')->nullable();
            $table->string('general_req')->nullable();
            $table->string('status_job')->nullable();
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
        Schema::dropIfExists('r_registjob');
    }
};
