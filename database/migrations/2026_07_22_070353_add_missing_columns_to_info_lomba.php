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
        Schema::table('info_lomba', function (Blueprint $table) {
            $table->text('syarat_ketentuan')->nullable()->after('deskripsi');
            $table->string('hadiah')->nullable()->after('syarat_ketentuan');
            $table->date('tanggal_mulai_pelaksanaan')->nullable()->after('tanggal_selesai_pendaftaran');
            $table->date('tanggal_selesai_pelaksanaan')->nullable()->after('tanggal_mulai_pelaksanaan');
            $table->string('tempat_pelaksanaan')->nullable()->after('tanggal_selesai_pelaksanaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_lomba', function (Blueprint $table) {
            $table->dropColumn([
                'syarat_ketentuan',
                'hadiah',
                'tanggal_mulai_pelaksanaan',
                'tanggal_selesai_pelaksanaan',
                'tempat_pelaksanaan',
            ]);
        });
    }
};
