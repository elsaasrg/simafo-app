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
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('jenis_surat');
            $table->text('keperluan');
            $table->string('file_lampiran'); // Persyaratan dari mahasiswa (KTM/UKT/Proposal)
            $table->string('file_surat_keluar')->nullable(); // Surat hasil scan TTD dari Admin
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('keterangan_admin')->nullable(); // Alasan jika ditolak
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
