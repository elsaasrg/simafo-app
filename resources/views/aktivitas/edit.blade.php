@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <h4 class="text-center font-weight-bold">EDIT DATA AKTIVITAS</h4>
        <div class="col-md-11">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-yellow-4 text-dark py-3">
                    <h6 class="m-0"><strong><i class="fas fa-edit mr-1"></i>Form Edit Data Aktivitas</strong></h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Jenis Kegiatan --}}
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kegiatan" class="form-label font-weight-bold">Jenis Kegiatan <span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_kegiatan') is-invalid @enderror" name="jenis_kegiatan" id="jenis_kegiatan" required>
                                    <option value="">-- Pilih Jenis Kegiatan --</option>
                                    <option value="Akademik" {{ old('jenis_kegiatan', $aktivitas->jenis_kegiatan) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="Non Akademik" {{ old('jenis_kegiatan', $aktivitas->jenis_kegiatan) == 'Non Akademik' ? 'selected' : '' }}>Non Akademik</option>
                                </select>
                                @error('jenis_kegiatan')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Periode Akademik --}}
                            <div class="col-md-6 mb-3">
                                <label for="periode_akademik" class="form-label font-weight-bold">Periode Akademik <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('periode_akademik') is-invalid @enderror" name="periode_akademik" value="{{ old('periode_akademik', $aktivitas->periode_akademik) }}" placeholder="Contoh: 2025/2026 Ganjil" required>
                                @error('periode_akademik')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jenis Aktivitas --}}
                            <div class="col-md-6 mb-3">
                                <label for="jenis_aktivitas" class="form-label font-weight-bold">Jenis Aktivitas <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jenis_aktivitas') is-invalid @enderror" name="jenis_aktivitas" value="{{ old('jenis_aktivitas', $aktivitas->jenis_aktivitas) }}" placeholder="Contoh: Kompetisi / PKM / Organisasi" required>
                                @error('jenis_aktivitas')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Kelompok Aktivitas --}}
                            <div class="col-md-6 mb-3">
                                <label for="kelompok_aktivitas" class="form-label font-weight-bold">Kelompok Aktivitas <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kelompok_aktivitas') is-invalid @enderror" name="kelompok_aktivitas" value="{{ old('kelompok_aktivitas', $aktivitas->kelompok_aktivitas) }}" required>
                                @error('kelompok_aktivitas')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Nama Aktivitas --}}
                            <div class="col-md-12 mb-3">
                                <label for="nama_aktivitas" class="form-label font-weight-bold">Nama Aktivitas <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_aktivitas') is-invalid @enderror" name="nama_aktivitas" value="{{ old('nama_aktivitas', $aktivitas->nama_aktivitas) }}" required>
                                @error('nama_aktivitas')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tingkat Prestasi --}}
                            <div class="col-md-6 mb-3">
                                <label for="tingkat_prestasi" class="form-label font-weight-bold">Tingkat Prestasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tingkat_prestasi') is-invalid @enderror" name="tingkat_prestasi" value="{{ old('tingkat_prestasi', $aktivitas->tingkat_prestasi) }}" placeholder="Lokal / Nasional / Internasional" required>
                                @error('tingkat_prestasi')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Peringkat --}}
                            <div class="col-md-6 mb-3">
                                <label for="peringkat" class="form-label font-weight-bold">Peringkat (Opsional)</label>
                                <input type="text" class="form-control" name="peringkat" value="{{ old('peringkat', $aktivitas->peringkat) }}" placeholder="Juara 1 / Harapan 1">
                            </div>

                            {{-- Jenis Prestasi --}}
                            <div class="col-md-6 mb-3">
                                <label for="jenis_prestasi" class="form-label font-weight-bold">Jenis Prestasi (Opsional)</label>
                                <input type="text" class="form-control" name="jenis_prestasi" value="{{ old('jenis_prestasi', $aktivitas->jenis_prestasi) }}">
                            </div>

                            {{-- Jabatan --}}
                            <div class="col-md-6 mb-3">
                                <label for="jabatan" class="form-label font-weight-bold">Jabatan (Opsional)</label>
                                <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan', $aktivitas->jabatan) }}" placeholder="Ketua / Anggota / Peserta">
                            </div>

                            {{-- Penyelenggara --}}
                            <div class="col-md-6 mb-3">
                                <label for="penyelenggara" class="form-label font-weight-bold">Penyelenggara (Opsional)</label>
                                <input type="text" class="form-control" name="penyelenggara" value="{{ old('penyelenggara', $aktivitas->penyelenggara) }}">
                            </div>

                            {{-- Lokasi Aktivitas --}}
                            <div class="col-md-6 mb-3">
                                <label for="lokasi_aktivitas" class="form-label font-weight-bold">Lokasi Aktivitas (Opsional)</label>
                                <input type="text" class="form-control" name="lokasi_aktivitas" value="{{ old('lokasi_aktivitas', $aktivitas->lokasi_aktivitas) }}">
                            </div>

                            {{-- Tanggal Mulai --}}
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{ old('tanggal_mulai', $aktivitas->tanggal_mulai) }}" required>
                                @error('tanggal_mulai')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" value="{{ old('tanggal_selesai', $aktivitas->tanggal_selesai) }}" required>
                                @error('tanggal_selesai')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jenis Dokumen Pendukung --}}
                            <div class="col-md-6 mb-3">
                                <label for="jenis_dokumen_pendukung" class="form-label font-weight-bold">Jenis Dokumen Pendukung <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jenis_dokumen_pendukung') is-invalid @enderror" name="jenis_dokumen_pendukung" value="{{ old('jenis_dokumen_pendukung', $aktivitas->jenis_dokumen_pendukung) }}" placeholder="Sertifikat / Surat Tugas" required>
                                @error('jenis_dokumen_pendukung')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Dokumen Pendukung --}}
                            <div class="col-md-6 mb-3">
                                <label for="dokumen_pendukung" class="form-label font-weight-bold">
                                    Dokumen Pendukung <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                                </label>
                                <input type="file" class="form-control @error('dokumen_pendukung') is-invalid @enderror" name="dokumen_pendukung">
                                <small class="text-muted d-block mt-1">Format: PDF, JPG, JPEG, PNG (Maks: 2MB)</small>

                                @if($aktivitas->dokumen_pendukung)
                                <div class="mt-2">
                                    <a href="{{ asset('uploads/dokumen_aktivitas/' . $aktivitas->dokumen_pendukung) }}" target="_blank" class="btn btn-sm btn-outline-primary text-dark">
                                        <i class="fas fa-file-alt text-primary"></i> Lihat Dokumen Saat Ini
                                    </a>
                                </div>
                                @endif
                                @error('dokumen_pendukung')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-radius px-2">
                                Simpan
                            </button>
                            <a href="{{ route('aktivitas.index') }}" class="btn btn-sm px-2 btn-radius bg-dark px-3 text-white">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection