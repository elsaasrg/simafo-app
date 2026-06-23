<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'lihat-pengguna',
            'tambah-pengguna',
            'ubah-pengguna',
            'hapus-pengguna',

            'lihat-aktivitas-prestasi',
            'tambah-aktivitas-prestasi',
            'ubah-aktivitas-prestasi',
            'hapus-aktivitas-prestasi',
            'validasi-aktivitas-prestasi',
            'unduh-rekap-prestasi',

            'lihat-organisasi',
            'tambah-organisasi',
            'hapus-organisasi',
            'edit-organisasi',

            'lihat-beasiswa',
            'tambah-beasiswa',
            'hapus-beasiswa',
            'edit-beasiswa',

            'tambah-pengajuan-surat',
            'lihat-pengajuan-surat',

            'tambah-aduan',
            'lihat-aduan',
            'edit-aduan',
            'hapus-aduan',

            'tambah-konseling',
            'balas-koseling',

            'tambah-info-lomba',
            'edit-info-lomba',
            'hapus-info-lomba',

            'tambah-info-beasiswa',
            'edit-info-beasiswa',
            'hapus-info-beasiswa',

            'tambah-tracer-study',
            'edit-tracer-study',
            'lihat-tracer-study',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
