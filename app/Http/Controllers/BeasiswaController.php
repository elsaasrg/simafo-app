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
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $beasiswa = Beasiswa::where('mahasiswa_id', Auth::user()->mahasiswa->id)->paginate(10);
        } else if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur')) {

            // Inisialisasi query utama dengan memuat relasi mahasiswa dan user
            $query = Beasiswa::with(['mahasiswa.user'])->orderBy('id', 'DESC');


            // 1. Fitur Cari (Nama Mahasiswa, NIM, Nama Beasiswa, atau Penyelenggara)
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($mainQuery) use ($search) {
                    $mainQuery->where('nama_beasiswa', 'LIKE', '%' . $search . '%')
                        ->orWhere('penyelenggara', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('mahasiswa', function ($q) use ($search) {
                            $q->where('nim', 'LIKE', '%' . $search . '%')
                                ->orWhereHas('user', function ($qu) use ($search) {
                                    $qu->where('name', 'LIKE', '%' . $search . '%');
                                });
                        });
                });
            }

            // 2. Dropdown Kategori: Status Validasi
            if ($request->filled('status') && $request->status !== 'semua') {
                $query->where('status_validasi', $request->status);
            }

            // 3. Dropdown Kategori: Tahun Mulai (Menggunakan whereYear untuk kolom tipe DATE)
            if ($request->filled('tahun') && $request->tahun !== 'semua') {
                $query->whereYear('tanggal_mulai', $request->tahun);
            }


            // Gunakan appends agar filter tidak ter-reset saat berpindah halaman pagination
            $beasiswa = $query->paginate(10)->appends($request->all());
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


    public function cetakLaporan(Request $request)
    {
        // Pastikan hanya Admin atau Kajur yang bisa mengakses cetak laporan
        if (!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Kajur')) {
            abort(403, 'Unauthorized action.');
        }

        $query = Beasiswa::with(['mahasiswa.user'])->orderBy('id', 'DESC');

        // Terapkan filter yang sama dengan halaman index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($mainQuery) use ($search) {
                $mainQuery->where('nama_beasiswa', 'LIKE', '%' . $search . '%')
                    ->orWhere('penyelenggara', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($q) use ($search) {
                        $q->where('nim', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('user', function ($qu) use ($search) {
                                $qu->where('name', 'LIKE', '%' . $search . '%');
                            });
                    });
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_validasi', $request->status);
        }

        if ($request->filled('tahun') && $request->tahun !== 'semua') {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        $beasiswa = $query->get(); // Ambil semua data tanpa pagination untuk cetak laporan

        return view('beasiswa.cetak_laporan', compact('beasiswa'));
    }
}
