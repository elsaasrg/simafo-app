<?php

namespace App\Http\Controllers;

use App\Models\TempatKp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempatKpController extends Controller
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
            'tahun_kp' => 'nullable|numeric',
        ]);

        // Menggunakan Eloquent Model untuk menyimpan data
        TempatKp::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'tahun_kp' => $request->tahun_kp
        ]);

        return redirect()->back()->with('success', 'Data Tempat KP berhasil ditambahkan!');
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
            'tahun_kp' => 'nullable|numeric',
        ]);

        // Mencari data berdasarkan ID, lalu perbarui menggunakan Eloquent
        $tempatKp = TempatKp::findOrFail($id);
        $tempatKp->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'tahun_kp' => $request->tahun_kp
        ]);

        return redirect()->back()->with('success', 'Data Tempat KP berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Pengaman hak akses Admin
        if (!Auth::user()->hasRole('Admin')) abort(403);

        // Mencari data berdasarkan ID, lalu hapus menggunakan Eloquent
        $tempatKp = TempatKp::findOrFail($id);
        $tempatKp->delete();

        return redirect()->back()->with('success', 'Data Tempat KP berhasil dihapus!');
    }
}
