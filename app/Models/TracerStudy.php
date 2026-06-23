<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    protected $table = 'tracer_study';

    protected $fillable = [
        'mahasiswa_id',
        'status_saat_ini',
        'masa_tunggu',
        'nama_pekerjaan',
        'lokasi_pekerjaan',
        'gaji',
        'tingkat_kesesuaian',
        'program_studi_lanjut',
        'institusi_studi_lanjut',
        'saran_perbaikan',
        'mahasiswa_id'
    ];
}
