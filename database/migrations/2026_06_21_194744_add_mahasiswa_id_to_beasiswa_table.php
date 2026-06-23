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
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beasiswa', function (Blueprint $table) {
            $table->dropColumn('mahasiswa_id');
        });
    }
};
