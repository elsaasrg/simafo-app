<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKp extends Model
{
    use HasFactory;

    protected $table = 'tempat_kp';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'deskripsi',
        'tahun_kp'
    ];
}
