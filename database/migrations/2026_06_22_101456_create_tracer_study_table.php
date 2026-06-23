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
        Schema::create('tracer_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->enum('status_saat_ini', ['bekerja', 'mencari_kerja', 'wirausaha', 'studi_lanjut']);
            $table->enum('masa_tunggu', ['kurang dari 3 bulan', '3-6 bulan', '6-12 bulan', '1-2 tahun', 'lebih dari 2 tahun'])->nullable();
            $table->string('nama_pekerjaan')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->bigInteger('gaji')->nullable();
            $table->tinyInteger('tingkat_kesesuaian')->nullable();
            $table->string('program_studi_lanjut')->nullable();
            $table->string('institusi_studi_lanjut')->nullable();
            $table->text('saran_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_study');
    }
};
