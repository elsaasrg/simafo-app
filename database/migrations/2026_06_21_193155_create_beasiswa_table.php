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
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_beasiswa');
            $table->string('penyelenggara');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('bukti_penerima');
            $table->enum('status_validasi', ['menunggu', 'diterima', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beasiswa');
    }
};
