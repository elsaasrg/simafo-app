<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        $kajur = Role::create(['name' => 'Kajur']);
        $dosen = Role::create(['name' => 'Dosen']);
        $dosenKemahasiswaan = Role::create(['name' => 'DosenKemahasiswaan']);
        $mahasiswa = Role::create(['name' => 'Mahasiswa']);
        $alumni = Role::create(['name' => 'Alumni']);

        $kajur->givePermissionTo([
            'unduh-rekap-prestasi',
        ]);

        $dosenKemahasiswaan->givePermissionTo([
            'tambah-info-lomba',
            'edit-info-lomba',
            'hapus-info-lomba',

            'tambah-info-beasiswa',
            'edit-info-beasiswa',
            'hapus-info-beasiswa',
        ]);

        $mahasiswa->givePermissionTo([
            'tambah-aktivitas-prestasi',
            'ubah-aktivitas-prestasi',
            'hapus-aktivitas-prestasi',
            'tambah-pengajuan-surat',
            'lihat-pengajuan-surat',
            'tambah-aduan',
            'lihat-aduan',
            'edit-aduan',
            'hapus-aduan',
            'tambah-konseling',
            'lihat-beasiswa',
            'tambah-beasiswa',
            'hapus-beasiswa',
            'edit-beasiswa',
            'lihat-organisasi',
            'tambah-organisasi',
            'hapus-organisasi',
            'edit-organisasi',
        ]);

        $dosen->givePermissionTo([
            'balas-koseling',
        ]);

        $alumni->givePermissionTo([
            'tambah-tracer-study',
            'edit-tracer-study',
            'lihat-tracer-study',
        ]);
    }
}
