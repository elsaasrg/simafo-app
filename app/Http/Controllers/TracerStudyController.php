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
    public function index()
    {
        $user = Auth::user();

        // 1. Jalur Admin / Staf (Melihat semua rekap data tracer study mahasiswa)
        if ($user->hasRole('Admin') || $user->hasRole('Kajur')) {
            $tracerstudy = TracerStudy::with('mahasiswa')->latest()->paginate(10);
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
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Alumni')) abort(403);

        $request->validate([
            'status_saat_ini'        => 'required|string',
            'masa_tunggu'            => 'nullable|string',
            'nama_pekerjaan'         => 'nullable|string',
            'lokasi_kerja'           => 'nullable|string',
            'gaji'                   => 'nullable|numeric',
            'tingkat_kesesuaian'     => 'nullable|integer|between:1,5',
            'program_studi_lanjut'   => 'nullable|string',
            'institusi_studi_lanjut' => 'nullable|string',
            'saran_perbaikan'        => 'nullable|string'
        ]);

        $input = $request->all();
        $input['mahasiswa_id'] = Auth::user()->mahasiswa->id;

        TracerStudy::create($input);

        return redirect()->route('tracer-study.index')->withSuccess('Tracer Study berhasil disimpan');
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
        if (!Auth::user()->hasRole('Alumni')) abort(403);

        $request->validate([
            'status_saat_ini' => 'required|string',
        ]);

        $tracerStudy->update($request->all());

        return redirect()->route('tracer-study.index')->withSuccess('Tracer Study berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TracerStudy $tracerStudy)
    {
        if (!Auth::user()->hasRole('Admin')) abort(403);

        $tracerStudy->delete();
        return redirect()->route('tracer-study.index')->withSuccess('Tracer Study berhasil dihapus');
    }
}
