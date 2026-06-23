<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $organisasi = Organisasi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->paginate(10);
        } else if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur')) {
            $organisasi = Organisasi::with('mahasiswa')->orderBy('id', 'DESC')->paginate(3);
        }
        return view('organisasi.index', compact('organisasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organisasi.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input agar data kosong tidak lolos ke database
        $validatedData = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jabatan'         => 'required|string|max:255',
            'tahun_mulai'     => 'required|numeric|digits:4',
            'tahun_selesai'   => 'required|numeric|digits:4',
            'dokumen'         => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        // 2. Hubungkan dengan ID mahasiswa yang sedang login
        $validatedData['mahasiswa_id'] = auth()->user()->mahasiswa->id;

        // 3. Proses penyimpanan file ke dalam storage (folder: public/dokumen)
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            // Menyimpan file dan mengambil path dokumennya
            $path = $file->store('dokumen', 'public');

            // Simpan path dokumen tersebut ke dalam array data database
            $validatedData['dokumen'] = $path;
        }

        // 4. Masukkan data yang sudah tervalidasi dan aman ke database
        Organisasi::create($validatedData);

        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisasi $organisasi)
    {
        return view(
            'organisasi.edit',
            ['organisasi' => $organisasi]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisasi $organisasi)
    {
        // 1. Validasi data (dokumen dibuat nullable karena sifatnya opsional saat edit)
        $validatedData = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jabatan'         => 'required|string|max:255',
            'tahun_mulai'     => 'required|numeric|digits:4',
            'tahun_selesai'   => 'required|numeric|digits:4',
            'dokumen'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // 2. Jika user mengunggah file SK baru
        if ($request->hasFile('dokumen')) {
            // Hapus file lama dari storage jika datanya ada
            if ($organisasi->dokumen && Storage::disk('public')->exists($organisasi->dokumen)) {
                Storage::disk('public')->delete($organisasi->dokumen);
            }

            // Simpan file baru
            $file = $request->file('dokumen');
            $path = $file->store('dokumen', 'public');
            $validatedData['dokumen'] = $path;
        }

        // 3. Perbarui baris data di database
        $organisasi->update($validatedData);

        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisasi $organisasi)
    {
        $organisasi->delete();
        return redirect()->route('organisasi.index')->withSuccess('Data organisasi berhasil dihapus');
    }

    public function updateStatusValidasi(Request $request, Organisasi $organisasi)
    {
        $request->validate([
            'status_validasi' => 'required|in:menunggu,diterima,ditolak'
        ]);

        $organisasi->update([
            'status_validasi' => $request->status_validasi
        ]);

        return redirect()->route('organisasi.index', $organisasi->id)->with('success', 'Status berhasil diperbarui');
    }
}
