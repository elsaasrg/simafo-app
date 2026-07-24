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
        Schema::table('tracer_study', function (Blueprint $table) {
            $table->enum('sektor_kerja', [
                'instansi_pemerintah',
                'bumn_bumd',
                'swasta',
                'organisasi_multilateral',
                'wirausaha',
                'lainnya'
            ])->nullable()->after('lokasi_kerja');
            $table->string('metode_cari_kerja')->nullable()->after('sektor_kerja');
            $table->enum('sumber_dana_studi', ['biaya_sendiri', 'beasiswa'])->nullable()->after('institusi_studi_lanjut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracer_study', function (Blueprint $table) {
            $table->dropColumn(['sektor_kerja', 'lokasi_kerja', 'metode_cari_kerja', 'sumber_dana_studi']);
        });
    }
};
