<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'nama_beasiswa',
        'penyelenggara',
        'tanggal_mulai',
        'tanggal_selesai',
        'bukti_penerima',
        'status_validasi',
    ];

    protected $table = 'beasiswa';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
