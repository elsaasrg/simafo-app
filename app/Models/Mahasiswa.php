<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'angkatan',
        'status',
        'tahun_lulus'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }
    public function organisasi()
    {
        return $this->hasMany(Organisasi::class);
    }

    public function beasiswa()
    {
        return $this->hasMany(Beasiswa::class);
    }

    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function konseling()
    {
        return $this->hasMany(Konseling::class);
    }

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class);
    }
}
