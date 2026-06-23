<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_beasiswa',
        'deskripsi',
        'syarat',
        'benefit',
        'penyelenggara',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'link_pendaftaran',
        'contact_person'
    ];

    protected  $table = 'info_beasiswa';
}
