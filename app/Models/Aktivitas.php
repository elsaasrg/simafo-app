<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';

    protected $fillable = [
        'mahasiswa_id',
        'periode_akademik',
        'jenis_aktivitas',
        'kelompok_aktivitas',
        'nama_aktivitas',
        'tingkat_prestasi',
        'peringkat',
        'jenis_prestasi',
        'jabatan',
        'penyelenggara',
        'lokasi_aktivitas',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_dokumen_pendukung',
        'dokumen_pendukung',
        'jenis_kegiatan',
        'poin',
        'status_validasi',
        'catatan_admin',
    ];

    public function mahasiswa()
    {

        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
