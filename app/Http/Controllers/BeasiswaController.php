<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $beasiswa = Beasiswa::where('mahasiswa_id', Auth::user()->mahasiswa->id)->paginate(10);
        } else {

            $beasiswa = Beasiswa::with('mahasiswa')->orderBy('id', 'DESC')->paginate(3);
        }
        return view('beasiswa.index', compact('beasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('beasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input secara ketat (mimes dan ukuran file maks 2MB)
        $validatedData = $request->validate([
            'nama_beasiswa'   => 'required|string|max:255',
            'penyelenggara'   => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai', // Validasi logis tanggal
            'bukti_penerima'  => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // 2. Kaitkan dengan ID Mahasiswa yang sedang login
        $validatedData['mahasiswa_id'] = auth()->user()->mahasiswa->id;

        // 3. Proses upload berkas Bukti Penerima ke Storage
        if ($request->hasFile('bukti_penerima')) {
            $file = $request->file('bukti_penerima');

            // Menyimpan berkas ke dalam folder 'public/bukti_beasiswa'
            $path = $file->store('bukti_beasiswa', 'public');

            // Ubah isi array 'bukti_penerima' dari objek file menjadi string path lokasinya
            $validatedData['bukti_penerima'] = $path;
        }

        // 4. Simpan data yang telah tervalidasi dan aman ke database
        Beasiswa::create($validatedData);

        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beasiswa $beasiswa)
    {
        return view('beasiswa.edit', [
            'beasiswa' => $beasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beasiswa $beasiswa)
    {
        $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'penyelenggara' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'bukti_penerima' => 'required',
        ]);

        $beasiswa->update([
            'nama_beasiswa' => $request->nama_beasiswa,
            'penyelenggara' => $request->penyelenggara,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'bukti_penerima' => $request->bukti_penerima,
        ]);

        return redirect()->route('beasiswa.index')->withSuccess('Data beasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->delete();
        return redirect()->route('beasiswa.index')->withSuccess('Data beasiswa berhasil dihapus');
    }

    public function updateStatus(Request $request, Beasiswa $beasiswa)
    {
        $request->validate([
            'status_validasi' => 'required|in:menunggu,diterima,ditolak'
        ]);

        $beasiswa->update([
            'status_validasi' => $request->status_validasi
        ]);

        return redirect()->route('beasiswa.index', $beasiswa->id)->with('success', 'Status validasi berhasil diperbarui');
    }
}
