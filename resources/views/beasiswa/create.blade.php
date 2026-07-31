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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- Main Card Form --}}
    <h4 class="font-weight-bold text-center">TAMBAH DATA BEASISWA</h4>
    <div class="card mb-4 ">
        <div class="card-header text-center bg-yellow-4 shadow-sm">
            <strong> <i class="fas fa-edit mr-1"></i> Form Pengajuan Data Beasiswa</strong>
        </div>

        {{-- Padding bawah diperkecil (pb-2) agar merapat ke tombol kontrol --}}
        <div class="card-body p-4 pb-2">
            <form action="{{ route('beasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- 1. Nama Beasiswa --}}
                <div class="mb-4">
                    <label for="nama_beasiswa" class="form-label font-weight-bold">Nama Beasiswa <span class="text-danger">*</span></label>
                    <input type="text" name="nama_beasiswa" id="nama_beasiswa"
                        class="form-control @error('nama_beasiswa') is-invalid @enderror"
                        value="{{ old('nama_beasiswa') }}" placeholder="Contoh: Beasiswa Bank Indonesia">
                    @error('nama_beasiswa')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 2. Penyelenggara --}}
                <div class="mb-4">
                    <label for="penyelenggara" class="form-label font-weight-bold">Penyelenggara <span class="text-danger">*</span></label>
                    <input type="text" name="penyelenggara" id="penyelenggara"
                        class="form-control @error('penyelenggara') is-invalid @enderror"
                        value="{{ old('penyelenggara') }}" placeholder="Contoh: Bank Indonesia / Kemendikbud">
                    @error('penyelenggara')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 3. Tanggal Mulai --}}
                <div class="mb-4">
                    <label for="tanggal_mulai" class="form-label font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                        class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        value="{{ old('tanggal_mulai', date('Y-m-d')) }}">
                    @error('tanggal_mulai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 4. Tanggal Selesai --}}
                <div class="mb-4">
                    <label for="tanggal_selesai" class="form-label font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                        value="{{ old('tanggal_selesai', date('Y-m-d')) }}">
                    @error('tanggal_selesai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 5. Bukti Penerima (Model Custom File Elegant ala AdminLTE) --}}
                <div class="mb-4">
                    <label for="bukti_penerima" class="form-label font-weight-bold">Bukti Penerima <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('bukti_penerima') is-invalid @enderror"
                                name="bukti_penerima" id="bukti_penerima" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label text-muted" for="bukti_penerima" id="bukti_penerima_label">Pilih berkas bukti (PDF, JPG, PNG maks 2MB)...</label>
                        </div>
                    </div>
                    @error('bukti_penerima')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <hr class="mt-4 mb-4">


                <div class="d-flex justify-content-end mb-2">
                    <button type="submit" class="btn btn-sm btn-primary px-2 btn-radius mr-1">
                        Tambah
                    </button>
                    <a href="{{ route('beasiswa.index') }}" class="btn btn-sm bg-dark px-3 btn-radius text-white">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script AdminLTE untuk mengubah teks label file secara real-time --}}
<script>
    document.getElementById('bukti_penerima').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih berkas bukti (PDF, JPG, PNG maks 2MB)...";
        var label = document.getElementById('bukti_penerima_label');
        label.textContent = fileName;
        label.classList.remove('text-muted');
    });
</script>
@endsection