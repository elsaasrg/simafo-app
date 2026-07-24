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
        Schema::table('beasiswa', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->nullable()->after('bukti_penerima');
            $table->enum('skema_pembayaran', ['Per Bulan', 'Per Semester', 'Per Tahun', 'Sekali Cair', 'Lainnya'])->default('Per Semester')->after('nominal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beasiswa', function (Blueprint $table) {
            $table->dropColumn([
                'nominal',
                'beasiswa'
            ]);
        });
    }
};
