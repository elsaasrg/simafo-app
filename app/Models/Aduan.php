<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;

    protected $table = 'aduan';

    protected $fillable = [
        'mahasiswa_id',
        'subjek',
        'isi_aduan',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
