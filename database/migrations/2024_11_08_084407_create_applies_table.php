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
        Schema::create('r_apply', function (Blueprint $table) {
            $table->string('apply_id')->nullable();
            $table->string('apply_det_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('bb')->nullable();
            $table->string('tb')->nullable();
            $table->string('jk')->nullable();
            $table->string('ttl')->nullable();
            $table->string('age')->nullable();
            $table->string('domisili')->nullable();
            $table->string('nik_ktp')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('jml_anak')->nullable();
            $table->string('riwayat_kesehatan')->nullable();
            $table->string('last_pendidikan')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('th_lulus')->nullable();
            $table->string('ipk')->nullable();
            $table->string('wa_aktif')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_apply');
    }
};
