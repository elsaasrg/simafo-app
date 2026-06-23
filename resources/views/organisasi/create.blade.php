@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    {{-- Header Judul & Breadcrumb --}}
    <h1 class="mt-4 font-weight-bold text-dark" style="font-size: 1.8rem;">Tambah Organisasi</h1>
    <ol class="breadcrumb mb-4 bg-light p-2 rounded small">
        <li class="breadcrumb-item"><a href="{{ route('organisasi.index') }}" class="text-decoration-none">Organisasi Saya</a></li>
        <li class="breadcrumb-item active">Input Baru</li>
    </ol>

    {{-- Alert Validation Error Global --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Main Card Form --}}
    <div class="card mb-4 border-0 shadow-sm">
        {{-- Header Card Hijau Khas SIMAFO --}}
        <div class="card-header bg-success text-white py-2">
            <i class="fas fa-edit me-1"></i> Form Pengajuan Riwayat Organisasi
        </div>

        <div class="card-body p-4 pb-2">
            <form action="{{ route('organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- 1. Nama Organisasi --}}
                <div class="mb-4">
                    <label for="nama_organisasi" class="form-label font-weight-bold">Nama Organisasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror"
                        name="nama_organisasi" value="{{ old('nama_organisasi') }}" id="nama_organisasi"
                        placeholder="Contoh: Badan Eksekutif Mahasiswa (BEM)">
                    @error('nama_organisasi')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 2. Jabatan --}}
                <div class="mb-4">
                    <label for="jabatan" class="form-label font-weight-bold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                        name="jabatan" value="{{ old('jabatan') }}" id="jabatan"
                        placeholder="Contoh: Ketua / Sekretaris / Anggota Divisi">
                    @error('jabatan')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 3. Tahun Mulai --}}
                <div class="mb-4">
                    <label for="tahun_mulai" class="form-label font-weight-bold">Tahun Mulai <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('tahun_mulai') is-invalid @enderror"
                        name="tahun_mulai" value="{{ old('tahun_mulai') }}" id="tahun_mulai"
                        placeholder="Contoh: 2024" min="2000" max="2100">
                    @error('tahun_mulai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 4. Tahun Selesai --}}
                <div class="mb-4">
                    <label for="tahun_selesai" class="form-label font-weight-bold">Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('tahun_selesai') is-invalid @enderror"
                        name="tahun_selesai" value="{{ old('tahun_selesai') }}" id="tahun_selesai"
                        placeholder="Contoh: 2025" min="2000" max="2100">
                    @error('tahun_selesai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="dokumen" class="form-label font-weight-bold">Dokumen (Bukti mengikuti organisasi )<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('dokumen') is-invalid @enderror"
                                name="dokumen" id="dokumen" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label text-muted" for="dokumen" id="dokumen_label">Pilih dokumen bukti (PDF, JPG, PNG maks 2MB)...</label>
                        </div>
                    </div>
                    @error('dokumen')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <hr class="mt-4 mb-4">

                {{-- Tombol Kontrol --}}
                <div class="d-flex justify-content-start mb-2">
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold me-2 shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan Organisasi
                    </button>
                    <a href="{{ route('organisasi.index') }}" class="btn btn-secondary px-4 shadow-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk mengubah teks label pencarian dokumen secara real-time saat file dipilih --}}
<script>
    document.getElementById('dokumen').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih dokumen bukti (PDF, JPG, PNG maks 2MB)...";
        var label = document.getElementById('dokumen_label');
        label.textContent = fileName;
        label.classList.remove('text-muted'); // Membuat teks nama file menjadi hitam tegas
    });
</script>
@endsection