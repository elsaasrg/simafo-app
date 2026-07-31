@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header text-center">
                <h4><strong>TAMBAH MAHASISWA</strong></h4>
            </div>

            <div class="card-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3 row">
                        <label for="name" class="col-form-label col-md-4 text-md-end text-start">Nama</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name">
                            @if($errors->has('name'))
                            <span class="text-danger small">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 row">
                        <label for="email" class="col-form-label col-md-4 text-md-end text-start">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email">
                            @if($errors->has('email'))
                            <span class="text-danger small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- NIM --}}
                    <div class="mb-3 row">
                        <label for="nim" class="col-form-label col-md-4 text-md-end text-start">NIM</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" id="nim">
                            @if($errors->has('nim'))
                            <span class="text-danger small">{{ $errors->first('nim') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- TAMBAHAN BARU: Status Mahasiswa --}}
                    <div class="mb-3 row">
                        <label for="status" class="col-form-label col-md-4 text-md-end text-start">Status Akademik</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" onchange="toggleTahunLulus()">
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus (Alumni)</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="text-danger small">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- TAMBAHAN BARU: Tahun Lulus (Otomatis muncul/sembunyi via JavaScript di bawah) --}}
                    <div class="mb-3 row" id="row_tahun_lulus" style="display: none;">
                        <label for="tahun_lulus" class="col-form-label col-md-4 text-md-end text-start">Tahun Lulus</label>
                        <div class="col-md-6">
                            <input type="number" min="1900" max="{{ date('Y') + 5 }}" placeholder="Contoh: 2026" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" value="{{ old('tahun_lulus') }}" id="tahun_lulus">
                            @if($errors->has('tahun_lulus'))
                            <span class="text-danger small">{{ $errors->first('tahun_lulus') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 row">
                        <label for="password" class="col-form-label col-md-4 text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @if($errors->has('password'))
                            <span class="text-danger small">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary btn-sm btn-radius" value="Tambah">
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm btn-radius bg-abu-abu">Batal</a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Fitur Interaktif Tambahan: Otomatis memunculkan input Tahun Lulus hanya jika statusnya "Lulus" --}}
<script>
    function toggleTahunLulus() {
        const statusSelect = document.getElementById('status');
        const rowTahunLulus = document.getElementById('row_tahun_lulus');

        if (statusSelect.value === 'lulus') {
            rowTahunLulus.style.display = 'flex'; // Gunakan flex agar sejalan dengan class 'row' Bootstrap
        } else {
            rowTahunLulus.style.display = 'none';
            document.getElementById('tahun_lulus').value = ''; // Kosongkan nilai jika status diubah kembali ke aktif
        }
    }

    // Jalankan fungsi saat halaman pertama kali dimuat (untuk mempertahankan old value jika validasi gagal)
    document.addEventListener("DOMContentLoaded", function() {
        toggleTahunLulus();
    });
</script>

@endsection