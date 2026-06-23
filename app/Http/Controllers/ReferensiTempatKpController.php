<?php

namespace App\Http\Controllers;

use App\Models\MitraJurusan;
use App\Models\TempatKp;
use Illuminate\Http\Request;

class ReferensiTempatKpController extends Controller
{
    public function index()
    {

        $mitraJurusan = MitraJurusan::all();


        $tempatKp = TempatKp::all();


        return view('referensi_tempat_kp.index', compact('mitraJurusan', 'tempatKp'));
    }
}
