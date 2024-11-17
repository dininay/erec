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
        Schema::create('r_result', function (Blueprint $table) {
            $table->string('result_id')->nullable();
            $table->string('test_id')->nullable();
            $table->string('reg_code')->nullable();
            $table->string('apply_id')->nullable();
            $table->string('result_name')->nullable();
            $table->string('status_result')->nullable();
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
        Schema::dropIfExists('r_result');
    }
};
