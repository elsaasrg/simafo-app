<?php

namespace App\Http\Controllers;

use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerStudyController extends Controller
{
    /**
     * Display a listing of the resource (Gerbang Utama Admin & Mahasiswa).
     */
    /**
     * Display a listing of the resource (Gerbang Utama Admin & Mahasiswa).
     */
    public function index(Request $request) // Tambahkan parameter Request di sini
    {
        $user = Auth::user();

        // 1. Jalur Admin / Staf (Melihat semua rekap data tracer study mahasiswa dengan Filter)
        if ($user->hasRole('Admin') || $user->hasRole('Kajur')) {

            // Inisialisasi query dengan relasi mahasiswa dan usernya
            $query = TracerStudy::with(['mahasiswa.user']);

            // Filter 1: Cari Nama atau NIM (Mencari ke tabel mahasiswa & user)
            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nim', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            // Filter 2: Tahun Lulus (Mencari di tabel mahasiswa)
            if ($request->filled('tahun')) {
                $tahun = $request->tahun;
                $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun_lulus', $tahun); // Sesuaikan nama kolom tahun lulus di tabel mahasiswamu
                });
            }

            // Filter 3: Status Saat Ini (Mencari di tabel tracer_studies)
            if ($request->filled('status')) {
                $status = $request->status;
                if ($status == 'bekerja') {
                    $query->where('status_saat_ini', 'like', '%bekerja%');
                } elseif ($status == 'wiraswasta') {
                    $query->where(function ($q) {
                        $q->where('status_saat_ini', 'like', '%wiraswasta%')
                            ->orWhere('status_saat_ini', 'like', '%wirausaha%');
                    });
                } elseif ($status == 'kuliah') {
                    $query->where(function ($q) {
                        $q->where('status_saat_ini', 'like', '%kuliah%')
                            ->orWhere('status_saat_ini', 'like', '%studi lanjut%')
                            ->orWhere('status_saat_ini', 'like', '%melanjutkan pendidikan%');
                    });
                } elseif ($status == 'mencari_kerja') {
                    $query->where(function ($q) {
                        $q->where('status_saat_ini', 'like', '%mencari kerja%')
                            ->orWhere('status_saat_ini', 'like', '%tidak bekerja%');
                    });
                }
            }

            // Eksekusi data dengan pagination
            $tracerstudy = $query->latest()->paginate(10);

            return view('tracer_study.admin.index', compact('tracerstudy'));
        }

        // 2. Jalur Mahasiswa / Alumni (Melihat halaman dashboard pribadinya sendiri)
        if ($user->hasRole('Mahasiswa') || $user->hasRole('Alumni')) {
            $mahasiswa = $user->mahasiswa;

            // Mengambil data tracer study milik mahasiswa yang sedang login jika sudah pernah mengisi
            $tracerstudy = TracerStudy::where('mahasiswa_id', $mahasiswa->id)->first();

            return view('tracer_study.alumni.index', compact('mahasiswa', 'tracerstudy'));
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
    /**
     * Show the form for creating a new resource (Hanya Mahasiswa).
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Alumni')) abort(403);

        $mahasiswa = Auth::user()->mahasiswa;
        return view('tracer_study.alumni.create', compact('mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Alumni') && !Auth::user()->hasRole('Mahasiswa')) abort(403);


        $validatedData = $request->validate([
            'status_saat_ini'        => 'required|string',
            'masa_tunggu'             => 'nullable|string',
            'nama_pekerjaan'         => 'nullable|string|max:255',
            'lokasi_kerja'           => 'nullable|string|max:255',
            'sektor_kerja'           => 'nullable|string|max:255',
            'metode_cari_kerja'      => 'nullable|string|max:255',
            'gaji'                   => 'nullable|numeric',
            'tingkat_kesesuaian'     => 'nullable|integer|between:1,5',
            'program_studi_lanjut'   => 'nullable|string|max:255',
            'institusi_studi_lanjut' => 'nullable|string|max:255',
            'sumber_dana_studi'      => 'nullable|in:biaya_sendiri,beasiswa',
            'saran_perbaikan'        => 'nullable|string'
        ]);

        $validatedData['mahasiswa_id'] = Auth::user()->mahasiswa->id;

        TracerStudy::create($validatedData);

        return redirect()->route('tracer-study.sukses')->with('success', 'Kuesioner Tracer Study berhasil disimpan.');
    }

    /**
     * Tampilan Terima Kasih & Cetak Bukti Wisuda
     */
    public function halamanSukses()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        return view('tracer_study.alumni.sukses', compact('mahasiswa'));
    }
    /**
     * Display the specified resource.
     */
    public function show(TracerStudy $tracerStudy)
    {
        $user = Auth::user();

        // Admin melihat detail tracer study mahasiswa tertentu
        if ($user->hasRole('Admin') || $user->hasRole('Kajur')) {
            return view('tracer_study.admin.show', compact('tracerStudy'));
        }

        // Mahasiswa melihat detail miliknya sendiri
        if ($user->hasRole('Alumni')) {
            // Memastikan mahasiswa tidak mengintip tracer study orang lain lewat URL
            if ($tracerStudy->mahasiswa_id !== $user->mahasiswa->id) {
                abort(403);
            }
            return view('tracer_study.alumni.show', compact('tracerStudy'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TracerStudy $tracerStudy)
    {
        $user = Auth::user();
        if (!$user->hasRole('Alumni')) abort(403);

        // Proteksi URL
        if ($tracerStudy->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403);
        }

        return view('tracer_study.alumni.edit', compact('tracerStudy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TracerStudy $tracerStudy)
    {
        $user = Auth::user();

        // 1. Cek Role Akses
        if (!$user->hasRole('Alumni') && !$user->hasRole('Mahasiswa')) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        // 2. Proteksi Akses: Mencegah alumni mengubah data milik alumni lain
        if ($tracerStudy->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403, 'Anda hanya dapat mengubah data milik Anda sendiri.');
        }

        // 3. Validasi Seluruh Field Sesuai Database
        $validatedData = $request->validate([
            'status_saat_ini'        => 'required|string',
            'masa_tunggu'             => 'nullable|string',
            'nama_pekerjaan'         => 'nullable|string|max:255',
            'lokasi_kerja'           => 'nullable|string|max:255',
            'sektor_kerja'           => 'nullable|string|max:255',
            'metode_cari_kerja'      => 'nullable|string|max:255',
            'gaji'                   => 'nullable|numeric',
            'tingkat_kesesuaian'     => 'nullable|integer|between:1,5',
            'program_studi_lanjut'   => 'nullable|string|max:255',
            'institusi_studi_lanjut' => 'nullable|string|max:255',
            'sumber_dana_studi'      => 'nullable|in:biaya_sendiri,beasiswa',
            'saran_perbaikan'        => 'nullable|string'
        ]);

        // 4. Update Data Hanya Menggunakan Field yang Tervalidasi
        $tracerStudy->update($validatedData);

        // 5. Redirect Kembali ke Dashboard/Index Alumni
        return redirect()->route('tracer-study.index')->with('success', 'Data Tracer Study berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TracerStudy $tracerStudy)
    {
        if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('Kajur')) abort(403);

        $tracerStudy->delete();
        return redirect()->route('tracer-study.index')->withSuccess('Tracer Study berhasil dihapus');
    }


    /**
     * Fitur Cetak Bukti untuk syarat Wisuda
     */

    // public function cetakBukti(int $id)
    // {
    //     $user = Auth::user();
    //     $tracerStudy = TracerStudy::with('mahasiswa.user')->findOrFail($id);


    //     if ($user->hasRole('Alumni') || $user->hasRole('Mahasiswa')) {
    //         if ($tracerStudy->mahasiswa_id !== $user->mahasiswa->id) {
    //             abort(403, 'Anda tidak berhak mengakses dokumen ini.');
    //         }
    //     }

    //     return view('tracer_study.alumni.cetak', compact('tracerStudy'));
    // }
}
