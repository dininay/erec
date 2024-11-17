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
        Schema::create('r_people_status', function (Blueprint $table) {
            $table->string('people_status_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('apply_id')->nullable();
            $table->string('test_id')->nullable();
            $table->string('status_admin')->nullable();
            $table->datetime('admin_date')->nullable();
            $table->string('status_interview')->nullable();
            $table->datetime('admin_interview')->nullable();
            $table->string('status_docclear')->nullable();
            $table->datetime('docclear_date')->nullable();
            $table->string('status_oje')->nullable();
            $table->datetime('oje_date')->nullable();
            $table->string('status_onboarding')->nullable();
            $table->datetime('onboarding_date')->nullable();
            $table->datetime('join_date')->nullable();
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
        Schema::dropIfExists('r_people_status');
    }
};
