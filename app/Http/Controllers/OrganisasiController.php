<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $organisasi = Organisasi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->paginate(10);
        } else if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur')) {

            // Inisialisasi query utama
            $query = Organisasi::with(['mahasiswa.user'])->orderBy('id', 'DESC');

            // --- LOCK FILTER HANYA UNTUK ADMIN ---
            if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur')) {

                // 1. Fitur Cari (Nama Mahasiswa, NIM, atau Nama Organisasi)
                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->where(function ($mainQuery) use ($search) {
                        $mainQuery->where('nama_organisasi', 'LIKE', '%' . $search . '%')
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

                // 3. Dropdown Kategori: Tahun Mulai
                if ($request->filled('tahun') && $request->tahun !== 'semua') {
                    $query->where('tahun_mulai', $request->tahun);
                }
            }

            // Simpan parameter request di pagination agar filter tidak reset saat pindah halaman
            $organisasi = $query->paginate(10)->appends($request->all());
        }
        return view('organisasi.index', compact('organisasi'));
    }

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


        $validatedData['mahasiswa_id'] = auth()->user()->mahasiswa->id;

        // 3. Proses penyimpanan file ke dalam storage (folder: public/dokumen)
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            // Menyimpan file dan mengambil path dokumennya
            $path = $file->store('dokumen', 'public');

            // Simpan path dokumen tersebut ke dalam array data database
            $validatedData['dokumen'] = $path;
        }

        // Masukkan data yang sudah tervalidasi ke database
        Organisasi::create($validatedData);

        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil ditambahkan');
    }

    public function edit(Organisasi $organisasi)
    {
        return view(
            'organisasi.edit',
            ['organisasi' => $organisasi]
        );
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jabatan'         => 'required|string|max:255',
            'tahun_mulai'     => 'required|numeric|digits:4',
            'tahun_selesai'   => 'required|numeric|digits:4',
            'dokumen'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Jika user mengunggah file baru
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

        //  Perbarui baris data di database
        $organisasi->update($validatedData);

        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil diperbarui');
    }

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

    public function cetakLaporan(Request $request)
    {
        if (!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Kajur')) {
            abort(403, 'Unauthorized action.');
        }

        $query = Organisasi::with(['mahasiswa.user'])->orderBy('id', 'DESC');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($mainQuery) use ($search) {
                $mainQuery->where('nama_organisasi', 'LIKE', '%' . $search . '%')
                    ->orWhere('jabatan', 'LIKE', '%' . $search . '%')
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
            $query->where('tahun_mulai', $request->tahun);
        }

        $organisasi = $query->get();

        return view('organisasi.cetak_laporan', compact('organisasi'));
    }
}
