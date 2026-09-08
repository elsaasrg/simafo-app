<?php

namespace App\Http\Controllers;

use App\Models\InfoBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('info_beasiswa.index', [
            'infoBeasiswa' => InfoBeasiswa::with('user')->where('tanggal_selesai_pendaftaran', '>=', now()->toDateString())
                ->orderBy('id', 'DESC')
                ->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('info_beasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('DosenKemahasiswaan') && !auth()->user()->hasRole('Admin')) {
            abort(403, 'Anda tidak memiliki akses untuk mengakses fungsi ini');
        }

        $validatedData = $request->validate([
            'nama_beasiswa'               => 'required|string|max:255',
            'deskripsi'                   => 'required|string',
            'syarat'                      => 'required|string',
            'benefit'                     => 'required|string',
            'penyelenggara'               => 'required|string|max:255',
            'tanggal_mulai_pendaftaran'   => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            'link_pendaftaran'            => 'nullable|url|max:255',
            'contact_person'              => 'nullable|string|max:50',
        ], [
            'tanggal_selesai_pendaftaran.after_or_equal' => 'Tanggal selesai pendaftaran tidak boleh mendahului tanggal mulai pendaftaran.',
            'link_pendaftaran.url' => 'Format link pendaftaran harus berupa URL yang valid (contoh: https://...).',
        ]);

        $validatedData['user_id'] = Auth::id();

        InfoBeasiswa::create($validatedData);

        return redirect()->route('info-beasiswa.index')->with('success', 'Informasi beasiswa berhasil diterbitkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoBeasiswa $infoBeasiswa)
    {
        if ($infoBeasiswa->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi beasiswa ini yang memiliki akses untuk mengubahnya');
        }

        return view('info_beasiswa.edit', [
            'infoBeasiswa' => $infoBeasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoBeasiswa $infoBeasiswa)
    {
        // PROTEKSI: Mencegah bypass update data milik orang lain via API/Postman
        if ($infoBeasiswa->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi beasiswa ini yang memiliki akses untuk mengubahnya');
        }

        $validatedData = $request->validate([
            'nama_beasiswa'               => 'required|string|max:255',
            'deskripsi'                   => 'required|string',
            'syarat'                      => 'required|string',
            'benefit'                     => 'required|string',
            'penyelenggara'               => 'required|string|max:255',
            'tanggal_mulai_pendaftaran'   => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            'link_pendaftaran'            => 'nullable|url|max:255',
            'contact_person'              => 'nullable|string|max:255'
        ], [
            'tanggal_selesai_pendaftaran.after_or_equal' => 'Tanggal selesai pendaftaran tidak boleh mendahului tanggal mulai pendaftaran.',
            'link_pendaftaran.url' => 'Format link pendaftaran harus berupa URL yang valid.',
        ]);

        $infoBeasiswa->update($validatedData);

        return redirect()->route('info-beasiswa.index')->with('success', 'Info beasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoBeasiswa $infoBeasiswa)
    {
        // PROTEKSI: Dosen hanya bisa hapus beasiswa bikinannya sendiri
        if ($infoBeasiswa->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat informasi beasiswa ini yang memiliki akses untuk menghapusnya');
        }

        $infoBeasiswa->delete();

        return redirect()->route('info-beasiswa.index')->with('success', 'Info beasiswa berhasil dihapus');
    }
}
