<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Aktivitas;
use App\Models\Beasiswa;
use App\Models\Dosen;
use App\Models\Konseling;
use App\Models\Mahasiswa;
use App\Models\Organisasi;
use App\Models\PengajuanSurat;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->hasRole('Admin')) {
            return view('home.admin', [
                // Total data
                'totalMahasiswa' => Mahasiswa::where('status', 'aktif')->count(),
                'totalAlumni' => Mahasiswa::where('status', 'lulus')->count(),
                'totalDosen' => Dosen::count(),
                'totalKonseling' => Konseling::count(),
                'totalAduan' => Aduan::count(),

                'totalTracerStudy' => TracerStudy::count(),
                'totalOrganisasi' => Organisasi::count(),
                'totalBeasiswa' => Beasiswa::count(),
                'totalAktivitas' => Aktivitas::count(),
                'totalPengajuanSurat' => PengajuanSurat::count(),

                // Ringkasan status
                'aduanMenunggu' => Aduan::where('status', 'menunggu')->count(),
                'aduanDiproses' => Aduan::where('status', 'diproses')->count(),
                'aduanSelesai' => Aduan::where('status', 'selesai')->count(),
                'aduanDitolak' => Aduan::where('status', 'ditolak')->count(),

                'organisasiMenunggu' => Organisasi::where('status_validasi', 'menunggu')->count(),
                'organisasiDiterima' => Organisasi::where('status_validasi', 'diterima')->count(),
                'organisasiDitolak' => Organisasi::where('status_validasi', 'ditolak')->count(),

                'beasiswaMenunggu' => Beasiswa::where('status_validasi', 'menunggu')->count(),
                'beasiswaDiterima' => Beasiswa::where('status_validasi', 'diterima')->count(),
                'beasiswaDitolak' => Beasiswa::where('status_validasi', 'ditolak')->count(),

                'aktivitasMenunggu' => Aktivitas::where('status_validasi', 'menunggu')->count(),
                'aktivitasValid' => Aktivitas::where('status_validasi', 'valid')->count(),
                'aktivitasTidakValid' => Aktivitas::where('status_validasi', 'tidak_valid')->count(),

                'pengajuanSuratMenunggu' => PengajuanSurat::where('status', 'menunggu')->count(),
                'pengajuanSuratDiproses' => PengajuanSurat::where('status', 'diproses')->count(),
                'pengajuanSuratSelesai' => PengajuanSurat::where('status', 'selesai')->count(),
                'pengajuanSuratDitolak' => PengajuanSurat::where('status', 'ditolak')->count(),

                // Data terbaru
                'pengajuanSuratTerbaru' => PengajuanSurat::where('status', 'menunggu')->latest()->take(5)->get(),
            ]);
        }

        if (Auth::user()->hasRole('Kajur')) {
            $dataLomba = \App\Models\InfoLomba::latest()->get()->map(function ($item) {
                $item->kategori_info = 'Lomba';
                return $item;
            });
            $dataBeasiswa = \App\Models\InfoBeasiswa::latest()->get()->map(function ($item) {
                $item->kategori_info = 'Beasiswa';
                return $item;
            });

            $pengumumanTerbaru = collect()
                ->merge($dataLomba)
                ->merge($dataBeasiswa)
                ->sortByDesc('created_at')
                ->take(3);

            $totalAduan    = \App\Models\Aduan::count();
            $aduanMenunggu = \App\Models\Aduan::where('status', 'menunggu')->count();
            $aduanDiproses = \App\Models\Aduan::where('status', 'diproses')->count();
            $aduanSelesai  = \App\Models\Aduan::where('status', 'selesai')->count();

            return view('home.kajur', compact(
                'pengumumanTerbaru',
                'totalAduan',
                'aduanMenunggu',
                'aduanDiproses',
                'aduanSelesai'
            ));
        }
        if (Auth::user()->hasRole('DosenKemahasiswaan')) {
            return view('home.dosen_kemahasiswaan');
        }
        if (Auth::user()->hasRole('Mahasiswa')) {
            $dataBeasiswa = \App\Models\InfoBeasiswa::latest()->get()->map(function ($item) {
                $item->kategori_info = 'beasiswa';
                return $item;
            });

            $dataLomba = \App\Models\InfoLomba::latest()->get()->map(function ($item) {
                $item->kategori_info = 'lomba';
                return $item;
            });

            $pengumumanTerbaru = collect()
                ->merge($dataBeasiswa)
                ->merge($dataLomba)
                ->sortByDesc('created_at')
                ->take(3);

            return view('home.mahasiswa', compact('pengumumanTerbaru'));
        }
        if (Auth::user()->hasRole('Dosen')) {
            return view('home.dosen');
        }
        if (Auth::user()->hasRole('Alumni')) {
            return view('home.alumni');
        }
    }
}
