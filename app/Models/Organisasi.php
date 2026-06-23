<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi';

    protected $fillable = [
        'mahasiswa_id',
        'nama_organisasi',
        'jabatan',
        'tahun_mulai',
        'tahun_selesai',
        'dokumen',
        'status_validasi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
