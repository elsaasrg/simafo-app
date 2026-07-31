@extends('layouts.app')

@section('content')



<div class="container-fluid px-4">

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

    <h4 class="font-weight-bold text-center mb-2">EDIT DATA BEASISWA</h4>
    <div class="card mb-4 ">
        <div class="card-header text-center bg-yellow-4 shadow-sm">
            <strong> <i class="fas fa-edit mr-1"></i> Form Edit Data Beasiswa</strong>
        </div>


        <div class="card-body p-4 pb-2">
            <form action="{{ route('beasiswa.update', $beasiswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 1. Nama Beasiswa --}}
                <div class="mb-4">
                    <label for="nama_beasiswa" class="form-label font-weight-bold">Nama Beasiswa <span class="text-danger">*</span></label>
                    <input type="text" name="nama_beasiswa" id="nama_beasiswa"
                        class="form-control @error('nama_beasiswa') is-invalid @enderror"
                        value="{{ old('nama_beasiswa', $beasiswa->nama_beasiswa) }}">
                    @error('nama_beasiswa')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 2. Penyelenggara --}}
                <div class="mb-4">
                    <label for="penyelenggara" class="form-label font-weight-bold">Penyelenggara <span class="text-danger">*</span></label>
                    <input type="text" name="penyelenggara" id="penyelenggara"
                        class="form-control @error('penyelenggara') is-invalid @enderror"
                        value="{{ old('penyelenggara', $beasiswa->penyelenggara) }}">
                    @error('penyelenggara')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 3. Tanggal Mulai --}}
                <div class="mb-4">
                    <label for="tanggal_mulai" class="form-label font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                        class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        value="{{ old('tanggal_mulai', $beasiswa->tanggal_mulai) }}">
                    @error('tanggal_mulai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 4. Tanggal Selesai --}}
                <div class="mb-4">
                    <label for="tanggal_selesai" class="form-label font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                        value="{{ old('tanggal_selesai', $beasiswa->tanggal_selesai) }}">
                    @error('tanggal_selesai')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- 5. Bukti Penerima (Model Custom File AdminLTE dengan Info Berkas Lama) --}}
                <div class="mb-4">
                    <label for="bukti_penerima" class="form-label font-weight-bold">Bukti Penerima</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('bukti_penerima') is-invalid @enderror"
                                name="bukti_penerima" id="bukti_penerima" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label text-muted" for="bukti_penerima" id="bukti_penerima_label">Pilih berkas baru jika ingin mengubah...</label>
                        </div>
                    </div>
                    @if($beasiswa->bukti_penerima)
                    <small class="form-text text-info mt-2">
                        <i class="fas fa-file-alt me-1"></i> Berkas saat ini:
                        <a href="{{ asset('storage/' . $beasiswa->bukti_penerima) }}" target="_blank" class="text-decoration-underline font-weight-bold">Lihat Bukti</a>
                    </small>
                    @endif
                    @error('bukti_penerima')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-sm btn-primary px-2 mr-1 shadow-sm btn-radius">
                        Simpan
                    </button>
                    <a href="{{ route('beasiswa.index') }}" class="btn btn-sm btn-dark px-3 shadow-sm btn-radius">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script AdminLTE Custom File Real-time Text --}}
<script>
    document.getElementById('bukti_penerima').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih berkas baru jika ingin mengubah...";
        var label = document.getElementById('bukti_penerima_label');
        label.textContent = fileName;
        label.classList.remove('text-muted');
    });
</script>
@endsection