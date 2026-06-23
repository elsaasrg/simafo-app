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
        Schema::create('info_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_beasiswa');
            $table->text('deskripsi');
            $table->text('syarat');
            $table->text('benefit');
            $table->string('penyelenggara');
            $table->date('tanggal_mulai_pendaftaran');
            $table->date('tanggal_selesai_pendaftaran');
            $table->string('link_pendaftaran')->nullable();
            $table->string('contact_person')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_beasiswa');
    }
};
