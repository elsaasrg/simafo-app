@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

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

    <h4 class="font-weight-bold text-center">EDIT DATA ORGANISASI </h4>
    <div class="card mb-4 ">
        <div class="card-header text-center bg-yellow-4 shadow-sm">
            <i class="fas fa-edit"></i><strong> Form Edit Data Organisasi</strong>
        </div>
        <div class="card-body p-4 pb-2">
            <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 1. Nama Organisasi --}}
                <div class="mb-4">
                    <label for="nama_organisasi" class="form-label font-weight-bold">Nama Organisasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror"
                        name="nama_organisasi" value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}" id="nama_organisasi"
                        placeholder="Contoh: Badan Eksekutif Mahasiswa (BEM)">
                    @error('nama_organisasi')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 2. Jabatan --}}
                <div class="mb-4">
                    <label for="jabatan" class="form-label font-weight-bold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                        name="jabatan" value="{{ old('jabatan', $organisasi->jabatan) }}" id="jabatan"
                        placeholder="Contoh: Ketua / Sekretaris / Anggota Divisi">
                    @error('jabatan')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 3. Tahun Mulai --}}
                <div class="mb-4">
                    <label for="tahun_mulai" class="form-label font-weight-bold">Tahun Mulai <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('tahun_mulai') is-invalid @enderror"
                        name="tahun_mulai" value="{{ old('tahun_mulai', $organisasi->tahun_mulai) }}" id="tahun_mulai"
                        placeholder="Contoh: 2024" min="2000" max="2100">
                    @error('tahun_mulai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 4. Tahun Selesai --}}
                <div class="mb-4">
                    <label for="tahun_selesai" class="form-label font-weight-bold">Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('tahun_selesai') is-invalid @enderror"
                        name="tahun_selesai" value="{{ old('tahun_selesai', $organisasi->tahun_selesai) }}" id="tahun_selesai"
                        placeholder="Contoh: 2025" min="2000" max="2100">
                    @error('tahun_selesai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 5. Dokumen (Sesuai Tampilan yang Diinginkan) --}}
                <div class="form-group mb-4">
                    <label for="dokumen" class="form-label font-weight-bold">
                        Dokumen (Bukti mengikuti organisasi )
                    </label>
                    <div>
                        <input type="file"
                            name="dokumen"
                            class="form-control @error('dokumen') is-invalid @enderror"
                            id="customFile"
                            accept=".pdf,.jpg,.jpeg,.png" placeholder="Pilih file baru jika ingin mengubah...">
                    </div>
                    <small class="form-text text-muted mb-1">Pilih file baru jika ingin mengubah..</small>

                    {{-- Menampilkan tautan file lama jika ada --}}
                    @if($organisasi->dokumen)
                    <a href="{{ asset('storage/' . $organisasi->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-primary text-dark"> <i class="fas fa-file-download text-primary mr-1"></i>Buka File Saat Ini</a>

                    @endif
                    @error('dokumen')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Tombol Kontrol --}}
                <div class="d-flex justify-content-end mb-2">
                    <button type="submit" class="btn btn-sm btn-primary px-2 mr-1 btn-radius">
                        Simpan
                    </button>
                    <a href="{{ route('organisasi.index') }}" class="btn btn-sm bg-dark px-3 btn-radius text-white">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection