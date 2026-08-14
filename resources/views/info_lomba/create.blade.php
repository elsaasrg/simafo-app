@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card shadow-sm">
            <div class="card-header text-center py-3">
                <h4 class="font-weight-bold m-0">TAMBAH INFORMASI LOMBA</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('info-lomba.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Lomba (NOT NULL) --}}
                    <div class="mb-3 row">
                        <label for="nama_lomba" class="col-form-label col-md-4 text-md-end text-start">
                            Nama Lomba <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('nama_lomba') is-invalid @enderror" name="nama_lomba" value="{{ old('nama_lomba') }}" id="nama_lomba" required>
                            @error('nama_lomba')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi (NOT NULL) --}}
                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-form-label col-md-4 text-md-end text-start">
                            Deskripsi <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Syarat & Ketentuan (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="syarat_ketentuan" class="col-form-label col-md-4 text-md-end text-start">Syarat & Ketentuan</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('syarat_ketentuan') is-invalid @enderror" name="syarat_ketentuan" id="syarat_ketentuan" rows="3">{{ old('syarat_ketentuan') }}</textarea>
                            @error('syarat_ketentuan')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Penyelenggara (NOT NULL) --}}
                    <div class="mb-3 row">
                        <label for="penyelenggara" class="col-form-label col-md-4 text-md-end text-start">
                            Penyelenggara <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" name="penyelenggara" value="{{ old('penyelenggara') }}" id="penyelenggara" required>
                            @error('penyelenggara')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="hadiah" class="col-form-label col-md-4 text-md-end text-start">Hadiah</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('hadiah') is-invalid @enderror" name="hadiah" value="{{ old('hadiah') }}" id="hadiah" placeholder="Contoh: Rp 10.000.000 + Sertifikat">
                            @error('hadiah')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Mulai Pendaftaran (NOT NULL) --}}
                    <div class="mb-3 row">
                        <label for="tanggal_mulai_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">
                            Tanggal Mulai Pendaftaran <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_mulai_pendaftaran') is-invalid @enderror" name="tanggal_mulai_pendaftaran" value="{{ old('tanggal_mulai_pendaftaran') }}" id="tanggal_mulai_pendaftaran" required>
                            @error('tanggal_mulai_pendaftaran')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Selesai Pendaftaran (NOT NULL) --}}
                    <div class="mb-3 row">
                        <label for="tanggal_selesai_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">
                            Tanggal Selesai Pendaftaran <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_selesai_pendaftaran') is-invalid @enderror" name="tanggal_selesai_pendaftaran" value="{{ old('tanggal_selesai_pendaftaran') }}" id="tanggal_selesai_pendaftaran" required>
                            @error('tanggal_selesai_pendaftaran')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Mulai Pelaksanaan (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="tanggal_mulai_pelaksanaan" class="col-form-label col-md-4 text-md-end text-start">Tanggal Mulai Pelaksanaan</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_mulai_pelaksanaan') is-invalid @enderror" name="tanggal_mulai_pelaksanaan" value="{{ old('tanggal_mulai_pelaksanaan') }}" id="tanggal_mulai_pelaksanaan">
                            @error('tanggal_mulai_pelaksanaan')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Selesai Pelaksanaan (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="tanggal_selesai_pelaksanaan" class="col-form-label col-md-4 text-md-end text-start">Tanggal Selesai Pelaksanaan</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_selesai_pelaksanaan') is-invalid @enderror" name="tanggal_selesai_pelaksanaan" value="{{ old('tanggal_selesai_pelaksanaan') }}" id="tanggal_selesai_pelaksanaan">
                            @error('tanggal_selesai_pelaksanaan')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tempat Pelaksanaan (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="tempat_pelaksanaan" class="col-form-label col-md-4 text-md-end text-start">Tempat Pelaksanaan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('tempat_pelaksanaan') is-invalid @enderror" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan') }}" id="tempat_pelaksanaan" placeholder="Contoh: Online / Gedung Utama Rektorat">
                            @error('tempat_pelaksanaan')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Link Pendaftaran (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="link_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">Link Pendaftaran</label>
                        <div class="col-md-6">
                            <input type="url" class="form-control @error('link_pendaftaran') is-invalid @enderror" name="link_pendaftaran" value="{{ old('link_pendaftaran') }}" id="link_pendaftaran" placeholder="https://...">
                            @error('link_pendaftaran')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Contact Person (NULLABLE) --}}
                    <div class="mb-3 row">
                        <label for="contact_person" class="col-form-label col-md-4 text-md-end text-start">Contact Person</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" id="contact_person" placeholder="Contoh: 08123456789 (Budi)">
                            @error('contact_person')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mb-3 row">
                        <div class="offset-md-8 col-md-6">
                            <button type="submit" class="btn btn-sm btn-primary btn-radius">Tambah</button>
                            <a href="{{ route('info-lomba.index') }}" class="btn btn-sm btn-dark text-white btn-radius px-3">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection