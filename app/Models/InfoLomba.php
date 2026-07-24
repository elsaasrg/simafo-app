<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoLomba extends Model
{
    use HasFactory;

    protected $table = 'info_lomba';

    protected $fillable = [
        'id',
        'user_id',
        'nama_lomba',
        'deskripsi',
        'penyelenggara',
        'syarat_ketentuan',
        'hadiah',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pelaksanaan',
        'tempat_pelaksanaan',
        'link_pendaftaran',
        'contact_person',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
