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
        Schema::create('tempat_kp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->year('tahun_kp')->nullable();
            $table->timestamps();
        });

        Schema::create('mitra_jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_kp');
        Schema::dropIfExists('mitra_jurusan');
    }
};
