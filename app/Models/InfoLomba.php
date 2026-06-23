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
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'link_pendaftaran',
        'contact_person',
        'poster',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
