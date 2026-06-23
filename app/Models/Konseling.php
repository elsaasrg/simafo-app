<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $table = 'konseling';

    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'subjek',
        'isi_konseling',
        'tanggapan_dosen',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsto(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsto(Dosen::class);
    }
}
