<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        return view('mahasiswa.index', [
            'mahasiswa' => Mahasiswa::orderBy('id', 'DESC')->paginate()
        ]);
    }

    public function create(): View
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswa',
            'status' => 'required|in:aktif,lulus',
            'tahun_lulus' => 'required_if:status,lulus|nullable|numeric|digits:4',
        ]);

        DB::beginTransaction();

        try {
            // Buat data user kredensial login
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? 'mahasiswa123')
            ]);

            // 3. Logika Penetapan Spatie Role secara dinamis
            if ($request->status === 'lulus') {
                $user->assignRole('Alumni');
            } else {
                $user->assignRole('Mahasiswa');
            }

            // 4. Hubungkan data profil ke tabel mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'status' => $request->status,
                'tahun_lulus' => $request->status === 'lulus' ? $request->tahun_lulus : null,
            ]);

            DB::commit();

            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil didaftarkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // 1. Validasi Update (Menghindari keunikan bentrok saat data tidak berubah)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
            'nim' => 'required|string|unique:mahasiswa,nim,' . $mahasiswa->id,
            'status' => 'required|in:aktif,lulus',
            'tahun_lulus' => 'required_if:status,lulus|nullable|numeric|digits:4',
        ]);

        DB::beginTransaction();

        try {

            // 2. Perbarui data dasar user
            $mahasiswa->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // 3. Sinkronisasi ulang Spatie Role agar menimpa role lama secara aman
            if ($request->status === 'lulus') {
                $mahasiswa->user->syncRoles(['Alumni']);
            } else {
                $mahasiswa->user->syncRoles(['Mahasiswa']);
            }

            // 4. Perbarui data tabel mahasiswa
            $mahasiswa->update([
                'nim' => $request->nim,
                'status' => $request->status,
                'tahun_lulus' => $request->status === 'lulus' ? $request->tahun_lulus : null,
            ]);

            DB::commit();

            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('mahasiswa.index')
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::beginTransaction();

        try {

            $user = $mahasiswa->user;

            $mahasiswa->delete();

            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa beserta akun loginnya berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('mahasiswa.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
