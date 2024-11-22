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
        Schema::create('r_apply_detail', function (Blueprint $table) {
            $table->integer('apply_det_id')->autoIncrement();
            $table->string('apply_id')->nullable();
            $table->string('quest_1')->nullable();
            $table->string('quest_2')->nullable();
            $table->string('quest_3')->nullable();
            $table->string('quest_4')->nullable();
            $table->string('quest_5')->nullable();
            $table->string('experience_1')->nullable();
            $table->string('experience_2')->nullable();
            $table->string('cv')->nullable();
            $table->string('photo')->nullable();
            $table->string('info_vacancy')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_apply_detail');
    }
};
