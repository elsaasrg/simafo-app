<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Aktivitas as ModelsAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $mahasiswaId = auth()->user()->mahasiswa->id;

            $aktivitas = Aktivitas::where('mahasiswa_id', $mahasiswaId)->latest()->get();

            // Hitung total poin yang sudah VALID untuk dashboard mahasiswa
            $totalPoin = Aktivitas::where('mahasiswa_id', $mahasiswaId)
                ->where('status_validasi', 'valid')
                ->sum('poin');

            return view('aktivitas.index', compact('aktivitas', 'totalPoin'));
        } else if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur') || auth()->user()->hasRole('Pembina')) {

            $query = Aktivitas::with('mahasiswa');


            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%")
                        ->orWhere('nim', 'like', "%$search%");
                });
            }

            if ($request->filled('periode')) {
                $query->where('periode_akademik', $request->periode);
            }


            if ($request->filled('status')) {
                $query->where('status_validasi', $request->status);
            }

            if ($request->filled('jenis')) {
                $query->where('jenis_aktivitas', $request->jenis);
            }

            $aktivitas = $query->latest()->get();

            return view('aktivitas.index', compact('aktivitas'));
        } else {
            abort(403, 'anda tidak memiliki akses ke halaman ini');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aktivitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form secara ketat tingkat aplikasi (Server-Side)
        $request->validate([
            'periode_akademik'        => 'required|string',
            'jenis_aktivitas'         => 'required', // Kunci pilihan dosen
            'kelompok_aktivitas'      => 'required|string',
            'nama_aktivitas'          => 'required|string|max:255',
            'tingkat_prestasi'        => 'required|string',
            'tanggal_mulai'           => 'required|date',
            'tanggal_selesai'         => 'required|date|after_or_equal:tanggal_mulai', // Tanggal selesai tidak boleh mendahului tanggal mulai
            'jenis_dokumen_pendukung' => 'required|string',
            'dokumen_pendukung'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Batasi file max 2MB
            'jenis_kegiatan'         => 'required|in:Akademik,Non Akademik',
        ]);

        $mahasiswaId = Auth::user()->mahasiswa->id;

        // Proses enkripsi dan pemindahan file dokumen/sertifikat yang diupload
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . '_skcpam_' . $mahasiswaId . '.' . $file->getClientOriginalExtension();

        // File akan disimpan secara fisik ke folder: public/uploads/dokumen_aktivitas/
        $file->move(public_path('uploads/dokumen_aktivitas'), $namaFile);

        // Eksekusi simpan ke database melalui Model Aktivitas
        Aktivitas::create([
            'mahasiswa_id'            => $mahasiswaId,
            'periode_akademik'        => $request->periode_akademik,
            'jenis_aktivitas'         => $request->jenis_aktivitas,
            'kelompok_aktivitas'      => $request->kelompok_aktivitas,
            'nama_aktivitas'          => $request->nama_aktivitas,
            'tingkat_prestasi'        => $request->tingkat_prestasi,
            'peringkat'               => $request->peringkat, // Nullable, otomatis aman jika kosong
            'jenis_prestasi'          => $request->jenis_prestasi, // Nullable
            'jabatan'                 => $request->jabatan, // Nullable
            'penyelenggara'           => $request->penyelenggara, // Nullable
            'lokasi_aktivitas'        => $request->lokasi_aktivitas, // Nullable
            'tanggal_mulai'           => $request->tanggal_mulai,
            'tanggal_selesai'         => $request->tanggal_selesai,
            'jenis_dokumen_pendukung' => $request->jenis_dokumen_pendukung,
            'dokumen_pendukung'       => $namaFile, // Menyimpan nama filenya saja di database
            'jenis_kegiatan'          => $request->jenis_kegiatan,
            'poin'                    => 0.00,       // Default awal 0.00 sebelum dinilai Admin
            'status_validasi'         => 'menunggu' // Default awal sebelum diperiksa Admin
        ]);

        // Kembalikan ke halaman index dengan notifikasi sukses
        return redirect()->route('aktivitas.index')->with('success', 'Data aktivitas berhasil diubah!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aktivitas $aktivita)
    {
        // Route Model Binding otomatis mencari data.
        // Kita simpan ke variabel $aktivitas agar konsisten dengan sintaks Anda yang lain.
        $aktivitas = $aktivita;

        // Validasi Otorisasi: Memastikan mahasiswa hanya bisa mengedit datanya sendiri
        if (Auth::user()->hasRole('Mahasiswa') && $aktivitas->mahasiswa_id !== Auth::user()->mahasiswa->id) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah data ini.');
        }

        // Validasi input
        $request->validate([
            'periode_akademik'        => 'required|string',
            'jenis_aktivitas'         => 'required',
            'kelompok_aktivitas'      => 'required|string',
            'nama_aktivitas'          => 'required|string|max:255',
            'tingkat_prestasi'        => 'required|string',
            'tanggal_mulai'           => 'required|date',
            'tanggal_selesai'         => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_dokumen_pendukung' => 'required|string',
            'dokumen_pendukung'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Nullable saat update
            'jenis_kegiatan'          => 'required|in:Akademik,Non Akademik',
        ]);

        $namaFile = $aktivitas->dokumen_pendukung;

        // Jika user mengunggah file dokumen pendukung baru
        if ($request->hasFile('dokumen_pendukung')) {
            $mahasiswaId = $aktivitas->mahasiswa_id;

            // Hapus file lama jika ada di direktori public
            $oldFilePath = public_path('uploads/dokumen_aktivitas/' . $aktivitas->dokumen_pendukung);
            if (\Illuminate\Support\Facades\File::exists($oldFilePath) && !empty($aktivitas->dokumen_pendukung)) {
                \Illuminate\Support\Facades\File::delete($oldFilePath);
            }

            // Simpan file baru
            $file = $request->file('dokumen_pendukung');
            $namaFile = time() . '_skcpam_' . $mahasiswaId . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/dokumen_aktivitas'), $namaFile);
        }

        // Update data aktivitas
        $aktivitas->update([
            'periode_akademik'        => $request->periode_akademik,
            'jenis_aktivitas'         => $request->jenis_aktivitas,
            'kelompok_aktivitas'      => $request->kelompok_aktivitas,
            'nama_aktivitas'          => $request->nama_aktivitas,
            'tingkat_prestasi'        => $request->tingkat_prestasi,
            'peringkat'               => $request->peringkat,
            'jenis_prestasi'          => $request->jenis_prestasi,
            'jabatan'                 => $request->jabatan,
            'penyelenggara'           => $request->penyelenggara,
            'lokasi_aktivitas'        => $request->lokasi_aktivitas,
            'tanggal_mulai'           => $request->tanggal_mulai,
            'tanggal_selesai'         => $request->tanggal_selesai,
            'jenis_dokumen_pendukung' => $request->jenis_dokumen_pendukung,
            'dokumen_pendukung'       => $namaFile,
            'jenis_kegiatan'          => $request->jenis_kegiatan,
            // Jika diedit oleh mahasiswa, kembalikan status validasi ke 'menunggu' dan poin ke 0.00
            'status_validasi'         => 'menunggu',
            'poin'                    => 0.00,
        ]);

        return redirect()->route('aktivitas.index')->with('success', 'Data aktivitas berhasil diperbarui!');
    }

    public function updateStatus(Request $request, int $id)
    {
        // Pastikan hanya Admin yang bisa mengeksekusi ini
        if (!Auth::user()->hasRole('Admin')) {
            abort(403, 'Anda tidak memiliki hak akses untuk memvalidasi data.');
        }

        // Validasi inputan admin
        $request->validate([
            'status_validasi' => 'required|in:valid,tidak_valid',
            'poin'            => 'required|numeric|min:0',
            'catatan_admin'   => 'nullable|string|max:255',
        ]);

        // Cari data aktivitas berdasarkan ID
        $aktivitas = Aktivitas::findOrFail($id);

        // Update data ke database
        $aktivitas->update([
            'status_validasi' => $request->status_validasi,
            'poin'            => $request->status_validasi == 'valid' ? $request->poin : 0.00, // Jika tidak valid, otomatis set poin ke 0
            'catatan_admin'   => $request->catatan_admin,
        ]);

        return redirect()->route('aktivitas.index')->with('success', 'Status validasi aktivitas berhasil diperbarui!');
    }


    public function edit(Aktivitas $aktivita)
    {
        $aktivitas = $aktivita;
        return view('aktivitas.edit', compact('aktivitas'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetak(Request $request)
    {
        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur')) {

            // 1. Ambil input filter dari URL (Sama seperti halaman index)
            $periode = $request->get('periode');
            $jenis = $request->get('jenis');
            $status = $request->get('status');
            $search = $request->get('search');

            // 2. Inisialisasi Query
            $query = Aktivitas::query()->with('mahasiswa');

            // 3. Filter Status Validasi
            if ($status) {
                $query->where('status_validasi', $status);
            }

            // 4. Perbaikan Filter Periode 
            // Menghindari error mismatch jika database menggunakan format tahun atau string
            if ($periode) {
                if (is_numeric($periode) || strlen($periode) == 4) {
                    $query->whereYear('tanggal_mulai', $periode);
                } else {
                    $query->where('periode_akademik', 'LIKE', '%' . $periode . '%');
                }
            }

            // 5. Perbaikan Filter Jenis Aktivitas
            // Menyelaraskan jika filter mengirim 'AK' (singkatan) atau 'Aktivitas Kemahasiswaan' (teks lengkap)
            if ($jenis) {
                if ($jenis == 'Aktivitas Kemahasiswaan' || $jenis == 'AK') {
                    $query->whereIn('jenis_aktivitas', ['AK', 'Aktivitas Kemahasiswaan']);
                } elseif ($jenis == 'Kompetisi' || $jenis == 'K') {
                    $query->whereIn('jenis_aktivitas', ['K', 'Kompetisi']);
                } elseif ($jenis == 'Program Kreativitas Mahasiswa' || $jenis == 'PKM') {
                    $query->whereIn('jenis_aktivitas', ['PKM', 'Program Kreativitas Mahasiswa']);
                } else {
                    $query->where('jenis_aktivitas', $jenis);
                }
            }

            // 6. Filter Pencarian Nama / NIM
            if ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nim', 'LIKE', '%' . $search . '%')
                        ->orWhere('nama_lengkap', 'LIKE', '%' . $search . '%');
                });
            }

            // 7. Ambil semua data hasil filter tanpa pagination (karena untuk dicetak)
            $laporan = $query->get();

            // Variabel pendukung template
            $prodi = "Sistem Informasi";

            // Kirim data ke view cetak
            return view('aktivitas.cetak_laporan', compact('laporan', 'prodi', 'status', 'periode', 'jenis'));
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini');
        }
    }
}
