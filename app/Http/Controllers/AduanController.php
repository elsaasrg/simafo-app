<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Jika Admin: Melihat seluruh aduan mahasiswa masuk untuk diproses
        if ($user->hasRole('Kajur')) {
            $aduan = Aduan::with('mahasiswa')->orderBy('id', 'DESC')->paginate(10);
            return view('aduan.admin.index', compact('aduan'));
        }
    }

    /**
     * Show the form for creating a new resource (Hanya Mahasiswa)
     */
    public function create()
    {
        return view('aduan.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage (Hanya Mahasiswa)
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
            'isi_aduan' => 'required|string',
        ]);

        Aduan::create([
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'subjek' => $request->subjek,
            'isi_aduan' => $request->isi_aduan,
            'status' => 'menunggu', // Status default awal aduan
        ]);

        return redirect()->route('aduan.index')->withSuccess('Aduan berhasil dikirim');
    }

    /**
     * Display the specified resource (Shared Detail)
     */
    public function show(Aduan $aduan)
    {
        $user = auth()->user();
        if ($user->hasRole('Mahasiswa')) {
            return view('aduan.mahasiswa.show', [
                'aduan' => $aduan
            ]);
        }

        if ($user->hasRole('Kajur')) {
            return view('aduan.admin.show', [
                'aduan' => $aduan
            ]);
        }
    }

    /**
     * Update status aduan (Hanya Admin untuk Verifikasi)
     */
    public function updateStatus(Request $request, Aduan $aduan)
    {
        // Fitur ini otomatis hanya dijalankan jika Admin merubah status aduan
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak'
        ]);

        $aduan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status aduan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aduan $aduan)
    {
        $aduan->delete();
        return redirect()->route('aduan.index')->withSuccess('Aduan berhasil dihapus');
    }
}
