@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 m-4">
            <div class="card shadow-sm">
                <div class="card-header text-center py-3">
                    <h4 class="mb-0 font-weight-bold ">TAMBAH INFORMASI BEASISWA</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('info-beasiswa.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="nama_beasiswa" class="col-md-3 col-form-label text-md-end">Nama Beasiswa</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('nama_beasiswa') is-invalid @enderror" name="nama_beasiswa" value="{{ old('nama_beasiswa') }}" id="nama_beasiswa">
                                @error('nama_beasiswa') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="penyelenggara" class="col-md-3 col-form-label text-md-end">Penyelenggara</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" name="penyelenggara" value="{{ old('penyelenggara') }}" id="penyelenggara">
                                @error('penyelenggara') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="deskripsi" class="col-md-3 col-form-label text-md-end">Deskripsi</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="syarat" class="col-md-3 col-form-label text-md-end">Syarat & Kriteria</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('syarat') is-invalid @enderror" name="syarat" id="syarat" rows="4" placeholder="Tuliskan poin-poin persyaratan...">{{ old('syarat') }}</textarea>
                                @error('syarat') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="benefit" class="col-md-3 col-form-label text-md-end">Benefit / Keuntungan</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('benefit') is-invalid @enderror" name="benefit" id="benefit" rows="4" placeholder="Contoh: Uang Saku bulanan...">{{ old('benefit') }}</textarea>
                                @error('benefit') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tanggal_mulai_pendaftaran" class="col-md-3 col-form-label text-md-end">Mulai Pendaftaran</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control @error('tanggal_mulai_pendaftaran') is-invalid @enderror" name="tanggal_mulai_pendaftaran" value="{{ old('tanggal_mulai_pendaftaran') }}" id="tanggal_mulai_pendaftaran">
                                @error('tanggal_mulai_pendaftaran') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tanggal_selesai_pendaftaran" class="col-md-3 col-form-label text-md-end">Selesai Pendaftaran</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control @error('tanggal_selesai_pendaftaran') is-invalid @enderror" name="tanggal_selesai_pendaftaran" value="{{ old('tanggal_selesai_pendaftaran') }}" id="tanggal_selesai_pendaftaran">
                                @error('tanggal_selesai_pendaftaran') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="link_pendaftaran" class="col-md-3 col-form-label text-md-end">Link Pendaftaran</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('link_pendaftaran') is-invalid @enderror" name="link_pendaftaran" value="{{ old('link_pendaftaran') }}" id="link_pendaftaran" placeholder="https://...">
                                @error('link_pendaftaran') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="contact_person" class="col-md-3 col-form-label text-md-end">Contact Person</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" id="contact_person">
                                @error('contact_person') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-8 offset-md-8">
                                <button type="submit" class="btn btn-primary btn-sm px-3 btn-radius">Tambah</button>
                                <a href="{{ route('info-beasiswa.index') }}" class="btn btn-sm bg-dark btn-radius px-4">Batal</a>
                            </div>


                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection