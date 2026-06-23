<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranSurat extends Model
{
    use HasFactory;

    protected $table = 'lampiran_surat';

    protected $fillable = [
        'pengajuan_surat_id',
        'nama_file',
    ];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class, 'pengajuan_surat_id');
    }
}
