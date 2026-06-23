<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@roles.id',
            'password' => Hash::make('123456')
        ]);

        $admin->assignRole('Admin');

        $kajur = User::create([
            'name' => 'Kajur',
            'email' => 'kajur@roles.id',
            'password' => Hash::make('123456')
        ]);

        $kajur->assignRole('Kajur');

        $mahasiswa = User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@roles.id',
            'password' => Hash::make('123456')
        ]);

        $mahasiswa->assignRole('Mahasiswa');
    }
}
