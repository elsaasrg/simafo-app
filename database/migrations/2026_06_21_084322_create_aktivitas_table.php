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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('periode_akademik');
            $table->string('jenis_aktivitas');
            $table->string('kelompok_aktivitas');
            $table->string('nama_aktivitas');
            $table->string('tingkat_prestasi');
            $table->string('peringkat')->nullable();
            $table->enum('jenis_kegiatan', ['Akademik', 'Non Akademik']);
            // jika prestasi
            $table->string('jenis_prestasi')->nullable();

            // Jika panitia,dll
            $table->string('jabatan')->nullable();

            $table->string('penyelenggara')->nullable();
            $table->string('lokasi_aktivitas')->nullable();

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jenis_dokumen_pendukung');
            $table->string('dokumen_pendukung');

            $table->decimal('poin', 5, 2)->default(0.00);
            $table->enum('status_validasi', ['menunggu', 'valid', 'tidak_valid'])->default('menunggu');
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
