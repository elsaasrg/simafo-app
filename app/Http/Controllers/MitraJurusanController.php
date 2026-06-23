<?php

namespace App\Http\Controllers;

use App\Models\MitraJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraJurusanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pengaman hak akses Admin
        if (!Auth::user()->hasRole('Admin')) abort(403);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        MitraJurusan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'deskripsi' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data Mitra resmi berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Pengaman hak akses Admin
        if (!Auth::user()->hasRole('Admin')) abort(403);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $mitraJurusan = MitraJurusan::findOrFail($id);
        $mitraJurusan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data Mitra resmi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Pengaman hak akses Admin
        if (!Auth::user()->hasRole('Admin')) abort(403);

        $mitraJurusan = MitraJurusan::findOrFail($id);
        $mitraJurusan->delete();

        return redirect()->back()->with('success', 'Data Mitra resmi berhasil dihapus!');
    }
}
