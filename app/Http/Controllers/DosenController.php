<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dosen.index', [
            'dosen' => Dosen::orderBy('id', 'DESC')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create', [
            'roles' => Role::whereIn('name', [
                'Dosen',
                'Kajur',
                'DosenKemahasiswaan'
            ])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'nip' => 'required|string|unique:dosen',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? 'dosen123')
            ]);

            $user->syncRoles($request->roles);


            Dosen::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
            ]);

            DB::commit();

            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil didaftarkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('dosen.index')->with('error', 'Gagal: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {

        $roles = Role::all();
        return view('dosen.edit', compact('dosen', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        // 1. Validasi Input (Menjaga keunikan email & nip kecuali milik dosen yang sedang di-edit)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dosen->user_id,
            'nip' => 'required|string|unique:dosen,nip,' . $dosen->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        DB::beginTransaction();

        try {
            // 2. Update data user (Nama dan Email)
            $dosen->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // 3. Sinkronisasi Kumpulan Role Baru (Spatie Multiple Roles)
            // Ini akan menghapus role lama dan menggantinya dengan pilihan role baru dari form
            $dosen->user->syncRoles($request->roles);

            // 4. Update data dosen (NIP)
            $dosen->update([
                'nip' => $request->nip,
            ]);

            DB::commit();

            return redirect()
                ->route('dosen.index')
                ->with('success', 'Data dosen berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('dosen.index')
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {

        DB::beginTransaction();

        try {

            $user = $dosen->user;


            $dosen->delete();

            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('dosen.index')->with('success', 'Dosen dan akun loginnya berhasil dihapus.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route('dosen.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
