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
        Schema::table('aduan', function (Blueprint $table) {
            $table->enum('kategori', [
                'akademik', //perkuliahan, nilai
                'kemahasiswaan', // organisasi,beasiswa,kegiatan
                'fasilitas', //ruang kelas, AC, Wi-Fi
                'layanan_administrasi', //pelayanan staf, surat-surat
                'perundungan_dan_etika', //bullying, pelecehan, pungli
                'lainnya'
            ])->after('mahasiswa_id');
            $table->string('lampiran')->nullable()->after('isi_aduan');
            $table->boolean('is_anonim')->default(false)->after('lampiran');
            $table->text('tanggapan')->nullable('')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            $table->dropColumn([
                'kategori',
                'lampiran',
                'is_anonim',
                'tanggapan'
            ]);
        });
    }
};
