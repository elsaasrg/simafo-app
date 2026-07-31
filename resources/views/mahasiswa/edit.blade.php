@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header text-center font-weight-bold">
                <h3>EDIT MAHASISWA</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3 row">
                        <label for="name" class="col-form-label col-md-4 text-md-end">Nama</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $mahasiswa->user->name) }}">
                            @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 row">
                        <label for="email" class="col-form-label col-md-4 text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $mahasiswa->user->email) }}">
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NIM --}}
                    <div class="mb-3 row">
                        <label for="nim" class="col-form-label col-md-4 text-md-end">NIM</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}">
                            @error('nim')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Status Akademik --}}
                    <div class="mb-3 row">
                        <label for="status" class="col-form-label col-md-4 text-md-end">Status Akademik</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" onchange="toggleTahunLulus()">
                                <option value="aktif" {{ old('status', $mahasiswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="lulus" {{ old('status', $mahasiswa->status) == 'lulus' ? 'selected' : '' }}>Lulus (Alumni)</option>
                            </select>
                            @error('status')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tahun Lulus (Dinamis muncul/sembunyi via JavaScript) --}}
                    <div class="mb-3 row" id="row_tahun_lulus" style="display: none;">
                        <label for="tahun_lulus" class="col-form-label col-md-4 text-md-end">Tahun Lulus</label>
                        <div class="col-md-6">
                            <input type="number" min="1900" max="{{ date('Y') + 5 }}" placeholder="Contoh: 2026" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus) }}">
                            @error('tahun_lulus')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3 row">
                        <label for="password" class="col-form-label col-md-4 text-md-end">Password Baru</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah password.</small>
                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-radius">Simpan</button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm btn-radius bg-abu-abu">Batal</a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Script Pengendali Input Tahun Lulus --}}
<script>
    function toggleTahunLulus() {
        const statusSelect = document.getElementById('status');
        const rowTahunLulus = document.getElementById('row_tahun_lulus');

        if (statusSelect.value === 'lulus') {
            rowTahunLulus.style.display = 'flex'; // Menggunakan flex agar sejalan dengan susunan kelas '.row' Bootstrap
        } else {
            rowTahunLulus.style.display = 'none';
            document.getElementById('tahun_lulus').value = '';
        }
    }

    // Eksekusi fungsi saat komponen DOM halaman pertama kali siap di-render
    document.addEventListener("DOMContentLoaded", function() {
        toggleTahunLulus();
    });
</script>

@endsection