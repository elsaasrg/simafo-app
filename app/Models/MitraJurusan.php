<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraJurusan extends Model
{
    use HasFactory;

    protected $table = 'mitra_jurusan';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'deskripsi'
    ];
}
