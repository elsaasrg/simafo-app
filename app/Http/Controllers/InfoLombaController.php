<?php

namespace App\Http\Controllers;

use App\Models\InfoLomba;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoLombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('info_lomba.index', [
            'infolomba' => InfoLomba::with('user')->where('tanggal_selesai_pendaftaran', '>=', now()->toDateString())
                ->orderBy('id', 'DESC')
                ->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasRole('DosenKemahasiswaan') && !auth()->user()->hasRole('Admin')) {
            abort(403, 'Anda tidak memiliki akses untuk mengakses fungsi ini');
        }

        return view('info_lomba.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validasi input secara ketat
        $validatedData = $request->validate([
            'nama_lomba'                  => 'required|string|max:255',
            'deskripsi'                   => 'required|string',
            'syarat_ketentuan'            => 'nullable|string',
            'penyelenggara'               => 'required|string|max:255',
            'hadiah'                      => 'nullable|string|max:255',
            'tanggal_mulai_pendaftaran'   => 'required|date',
            // Validasi logis: tanggal selesai pendaftaran harus sama atau setelah tanggal mulai pendaftaran
            'tanggal_selesai_pendaftaran' => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            'tanggal_mulai_pelaksanaan'   => 'nullable|date',
            // Validasi logis: tanggal selesai pelaksanaan harus sama atau setelah tanggal mulai pelaksanaan (jika diisi)
            'tanggal_selesai_pelaksanaan' => 'nullable|date|after_or_equal:tanggal_mulai_pelaksanaan',
            'tempat_pelaksanaan'          => 'nullable|string|max:255',
            'link_pendaftaran'            => 'nullable|url|max:255', // Memastikan format URL jika diisi
            'contact_person'              => 'nullable|string|max:255',
        ], [
            // Custom pesan error bahasa Indonesia agar informatif
            'nama_lomba.required'                        => 'Nama lomba wajib diisi.',
            'deskripsi.required'                         => 'Deskripsi lomba wajib diisi.',
            'penyelenggara.required'                     => 'Penyelenggara wajib diisi.',
            'tanggal_mulai_pendaftaran.required'         => 'Tanggal mulai pendaftaran wajib diisi.',
            'tanggal_selesai_pendaftaran.required'       => 'Tanggal selesai pendaftaran wajib diisi.',
            'tanggal_selesai_pendaftaran.after_or_equal' => 'Tanggal selesai pendaftaran tidak boleh mendahului tanggal mulai pendaftaran.',
            'tanggal_selesai_pelaksanaan.after_or_equal' => 'Tanggal selesai pelaksanaan tidak boleh mendahului tanggal mulai pelaksanaan.',
            'link_pendaftaran.url'                       => 'Format link pendaftaran harus berupa URL yang valid (contoh: https://...).',
        ]);

        // 2. Kaitkan secara otomatis dengan ID User/Dosen yang sedang login
        $validatedData['user_id'] = Auth::id();

        // 3. Simpan data yang telah tervalidasi ke dalam database
        InfoLomba::create($validatedData);

        // 4. Redirect kembali ke halaman index dengan flash message sukses
        return redirect()->route('info-lomba.index')->with('success', 'Informasi lomba berhasil diterbitkan!');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoLomba $infoLomba)
    {
        if ($infoLomba->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi lomba ini yang memiliki akses untuk mengubahnya');
        }
        return view('info_lomba.edit', [
            'infoLomba' => $infoLomba
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoLomba $infoLomba)
    {
        if ($infoLomba->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi lomba ini yang memiliki akses untuk mengubahnya');
        }
        // 1. Validasi input secara ketat
        $validatedData = $request->validate([
            'nama_lomba'                  => 'required|string|max:255',
            'deskripsi'                   => 'required|string',
            'syarat_ketentuan'            => 'nullable|string',
            'penyelenggara'               => 'required|string|max:255',
            'hadiah'                      => 'nullable|string|max:255',
            'tanggal_mulai_pendaftaran'   => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            'tanggal_mulai_pelaksanaan'   => 'nullable|date',
            'tanggal_selesai_pelaksanaan' => 'nullable|date|after_or_equal:tanggal_mulai_pelaksanaan',
            'tempat_pelaksanaan'          => 'nullable|string|max:255',
            'link_pendaftaran'            => 'nullable|url|max:255', // Memastikan format URL jika diisi
            'contact_person'              => 'nullable|string|max:255',
        ], [
            'nama_lomba.required'                        => 'Nama lomba wajib diisi.',
            'deskripsi.required'                         => 'Deskripsi lomba wajib diisi.',
            'penyelenggara.required'                     => 'Penyelenggara wajib diisi.',
            'tanggal_mulai_pendaftaran.required'         => 'Tanggal mulai pendaftaran wajib diisi.',
            'tanggal_selesai_pendaftaran.required'       => 'Tanggal selesai pendaftaran wajib diisi.',
            'tanggal_selesai_pendaftaran.after_or_equal' => 'Tanggal selesai pendaftaran tidak boleh mendahului tanggal mulai pendaftaran.',
            'tanggal_selesai_pelaksanaan.after_or_equal' => 'Tanggal selesai pelaksanaan tidak boleh mendahului tanggal mulai pelaksanaan.',
            'link_pendaftaran.url'                       => 'Format link pendaftaran harus berupa URL yang valid (contoh: https://...).',
        ]);

        // 2. Perbarui data yang telah tervalidasi ke dalam database
        $infoLomba->update($validatedData);

        // 3. Redirect kembali ke halaman index dengan flash message sukses
        return redirect()->route('info-lomba.index')->with('success', 'Informasi lomba berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoLomba $infoLomba)
    {
        if ($infoLomba->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi lomba ini yang memiliki akses untuk menghapusnya');
        }
        $infoLomba->delete();

        return redirect()->route('info-lomba.index')->withSuccess('Info lomba berhasil dihapus');
    }
}
