<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function lampiranSurat()
    {
        return $this->hasMany(LampiranSurat::class);
    }
}
