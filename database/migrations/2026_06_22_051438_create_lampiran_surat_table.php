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
        Schema::create('lampiran_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_surat_id')->constrained('pengajuan_surat')->onDelete('cascade');
            $table->string('nama_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran_surat');
    }
};
