<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource (Shared Index)
     */
    public function index()
    {
        $user = Auth::user();

        // Jika Mahasiswa: Hanya melihat aduan miliknya sendiri
        if ($user->hasRole('Mahasiswa')) {
            $aduan = Aduan::where('mahasiswa_id', $user->mahasiswa->id)->latest()->paginate(10);
            return view('aduan.mahasiswa.index', compact('aduan'));
        }

        // Jika Admin / Kajur: Melihat seluruh aduan mahasiswa yang masuk
        if ($user->hasRole('Kajur') || $user->hasRole('Admin')) {
            $aduan = Aduan::with('mahasiswa')->orderBy('id', 'DESC')->paginate(10);
            return view('aduan.admin.index', compact('aduan'));
        }

        abort(403, 'Akses ditolak.');
    }

    /**
     * Show the form for creating a new resource (Hanya Mahasiswa)
     */
    public function create()
    {
        if (!auth()->user()->hasRole('Mahasiswa')) abort(403);

        return view('aduan.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage (Hanya Mahasiswa)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori'  => 'required|in:kemahasiswaan,perundungan_dan_etika,akademik,fasilitas,layanan_administrasi,lainnya',
            'subjek'    => 'required|string|max:255',
            'isi_aduan' => 'required|string',
            'lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Proses upload file lampiran jika ada
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_aduan', 'public');
        }

        // Simpan ke database
        Aduan::create([
            'mahasiswa_id' => auth()->user()->mahasiswa->id ?? auth()->id(),
            'kategori'     => $request->kategori,
            'subjek'       => $request->subjek,
            'isi_aduan'    => $request->isi_aduan,
            'lampiran'     => $lampiranPath,
            'status'       => 'menunggu',
        ]);

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil dikirim!');
    }

    /**
     * Display the specified resource (Shared Detail)
     */
    public function show(Aduan $aduan)
    {
        $user = auth()->user();

        if ($user->hasRole('Mahasiswa')) {
            // Proteksi: Mencegah mahasiswa melihat aduan mahasiswa lain
            if ($aduan->mahasiswa_id !== $user->mahasiswa->id) {
                abort(403, 'Anda tidak berhak melihat aduan ini.');
            }

            return view('aduan.mahasiswa.show', [
                'aduan' => $aduan
            ]);
        }

        if ($user->hasRole('Kajur') || $user->hasRole('Admin')) {
            return view('aduan.admin.show', [
                'aduan' => $aduan
            ]);
        }

        abort(403);
    }

    /**
     * Update status & tanggapan aduan (Hanya Admin / Kajur)
     */
    public function updateStatus(Request $request, Aduan $aduan)
    {
        $user = auth()->user();
        if (!$user->hasRole('Admin') && !$user->hasRole('Kajur')) {
            abort(403);
        }

        $request->validate([
            'status'    => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string',
        ]);

        $aduan->update([
            'status'    => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->back()->with('success', 'Status dan tanggapan aduan berhasil diperbarui');
    }

    /**
     * Show the form for editing the specified resource (Hanya Mahasiswa)
     */
    public function edit(Aduan $aduan)
    {
        $user = auth()->user();
        if (!$user->hasRole('Mahasiswa')) abort(403);

        if ($aduan->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi Keamanan: Jika status bukan 'menunggu', tolak pengeditan
        if ($aduan->status !== 'menunggu') {
            return redirect()->route('aduan.index')->withErrors('Aduan tidak dapat diubah karena sedang diproses atau sudah selesai.');
        }

        return view('aduan.mahasiswa.edit', compact('aduan'));
    }

    /**
     * Update the specified resource in storage (Hanya Mahasiswa)
     */
    public function update(Request $request, Aduan $aduan)
    {
        $user = auth()->user();
        if (!$user->hasRole('Mahasiswa')) abort(403);

        if ($aduan->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi Keamanan Backend sebelum menyimpan perubahan data
        if ($aduan->status !== 'menunggu') {
            return redirect()->route('aduan.index')->withErrors('Aduan gagal diperbarui karena status sudah berubah.');
        }

        $request->validate([
            'kategori'  => 'required|in:kemahasiswaan,perundungan_dan_etika,akademik,fasilitas,layanan_administrasi,lainnya',
            'subjek'    => 'required|string|max:255',
            'isi_aduan' => 'required|string',
            'lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Jika mengunggah lampiran baru, hapus lampiran lama dari storage
        $lampiranPath = $aduan->lampiran;
        if ($request->hasFile('lampiran')) {
            if ($aduan->lampiran && Storage::disk('public')->exists($aduan->lampiran)) {
                Storage::disk('public')->delete($aduan->lampiran);
            }
            $lampiranPath = $request->file('lampiran')->store('lampiran_aduan', 'public');
        }

        $aduan->update([
            'kategori'  => $request->kategori,
            'subjek'    => $request->subjek,
            'isi_aduan' => $request->isi_aduan,
            'lampiran'  => $lampiranPath,
            'is_anonim' => $request->has('is_anonim') ? 1 : 0,
        ]);

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Aduan $aduan)
    {
        $user = auth()->user();

        if ($user->hasRole('Mahasiswa')) {
            if ($aduan->mahasiswa_id !== $user->mahasiswa->id) {
                abort(403, 'Anda tidak memiliki akses untuk menghapus aduan ini.');
            }

            if ($aduan->status !== 'menunggu') {
                return redirect()->route('aduan.index')->withErrors('Aduan tidak dapat dihapus karena sudah diproses.');
            }
        } elseif (!$user->hasRole('Admin') && !$user->hasRole('Kajur')) {
            abort(403);
        }

        // Hapus file lampiran dari folder storage jika file ada
        if ($aduan->lampiran && Storage::disk('public')->exists($aduan->lampiran)) {
            Storage::disk('public')->delete($aduan->lampiran);
        }

        $aduan->delete();

        return redirect()->back()->withSuccess('Aduan berhasil dihapus');
    }
}
