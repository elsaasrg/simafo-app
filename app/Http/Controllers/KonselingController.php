<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonselingController extends Controller
{
    /**
     * Display a listing of the resource (Mahasiswa & Dosen).
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Mahasiswa')) {
            $konseling = Konseling::where('mahasiswa_id', $user->mahasiswa->id)->latest()->paginate(10);
            return view('konseling.mahasiswa.index', compact('konseling'));
        }

        if ($user->hasRole('Dosen') || $user->hasRole('DosenKemahasiswaan')) {
            if (!$user->dosen) {
                abort(403, 'Profil Dosen Anda belum dikonfigurasi oleh Admin.');
            }

            $konseling = Konseling::where('dosen_id', $user->dosen->id)->latest()->paginate(10);
            return view('konseling.dosen.index', compact('konseling'));
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    /**
     * Show the form for creating a new resource (Mahasiswa saja).
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Mahasiswa')) abort(403);

        $listDosen = Dosen::all();
        return view('konseling.mahasiswa.create', compact('listDosen'));
    }

    /**
     * Store a newly created resource in storage (Mahasiswa saja).
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Mahasiswa')) abort(403);

        $request->validate([
            'subjek' => 'required|string|max:255',
            'isi_konseling' => 'required|string',
            'dosen_id' => 'required|exists:dosen,id',
        ]);

        Konseling::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'dosen_id' => $request->dosen_id,
            'subjek' => $request->subjek,
            'isi_konseling' => $request->isi_konseling,
            'status' => 'dikirim',
        ]);

        return redirect()->route('konseling.index')->withSuccess('Berhasil dikirim');
    }

    /**
     * Display the specified resource (Mahasiswa & Dosen).
     */
    public function show(Konseling $konseling)
    {
        $user = Auth::user();

        // JALUR DOSEN
        if ($user->hasRole('Dosen')) {
            // Otomatis ubah status menjadi dibaca saat dosen membuka detail
            if ($konseling->status == 'dikirim') {
                $konseling->update(['status' => 'dibaca']);
            }
            return view('konseling.dosen.show', compact('konseling'));
        }

        // JALUR MAHASISWA
        if ($user->hasRole('Mahasiswa')) {
            return view('konseling.mahasiswa.show', compact('konseling'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified resource (Mahasiswa saja).
     */
    public function edit(Konseling $konseling)
    {
        if (!Auth::user()->hasRole('Mahasiswa')) abort(403);

        return view('konseling.mahasiswa.edit', [
            'konseling' => $konseling,
            'listDosen' => Dosen::all()
        ]);
    }

    /**
     * Update the specified resource in storage (Mahasiswa & Dosen).
     */
    public function update(Request $request, Konseling $konseling)
    {
        $user = Auth::user();

        // PROSES UPDATE JALUR DOSEN (Memberikan Tanggapan)
        if ($user->hasRole('Dosen') || $user->hasRole('DosenKemahasiswaan')) {
            $request->validate([
                'tanggapan_dosen' => 'required|string',
            ]);

            $konseling->update([
                'tanggapan_dosen' => $request->tanggapan_dosen,
                'status' => 'dibalas',
            ]);

            return redirect()->route('konseling.index')->withSuccess('Berhasil mengirim tanggapan');
        }

        // PROSES UPDATE JALUR MAHASISWA (Mengedit Pengajuan)
        if ($user->hasRole('Mahasiswa')) {
            $request->validate([
                'subjek' => 'required|string|max:255',
                'isi_konseling' => 'required|string',
                'dosen_id' => 'required|exists:dosen,id',
            ]);

            $konseling->update([
                'subjek' => $request->subjek,
                'isi_konseling' => $request->isi_konseling,
                'dosen_id' => $request->dosen_id,
            ]);

            return redirect()->route('konseling.index')->withSuccess('Berhasil diubah');
        }

        abort(403);
    }

    /**
     * Remove the specified resource from storage (Mahasiswa saja).
     */
    public function destroy(Konseling $konseling)
    {
        if (!Auth::user()->hasRole('Mahasiswa')) abort(403);

        $konseling->delete();
        return redirect()->route('konseling.index')->withSuccess('Berhasil dihapus');
    }
}
