@extends('layouts.app')
@section('content')

{{-- Flash Message Berhasil --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="float-start">Data aduan</div>
                    <div class="float-end"><a href="{{ route('aduan.index') }}" class="btn btn-primary btn-sm">Kembali</a></div>
                </div>

            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Nama Mahasiswa:</strong></div>
                    <div class="col-md-6">{{ $aduan->mahasiswa->nama_lengkap }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Subjek:</strong></div>
                    <div class="col-md-6">{{ $aduan->subjek }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Isi aduan:</strong></div>
                    <div class="col-md-6">{{ $aduan->isi_aduan }}</div>
                </div>
                <div class="mb-3 row">
                    <form action="{{ route('aduan.updateStatus', $aduan->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <div class="col-md-4 text-md-end">
                                <strong>Status:</strong>
                            </div>

                            <div class="col-md-6 d-flex justify-content-start align-items-center gap-2">

                                <select name="status" class="form-select col-md-2 w-auto">

                                    <option value="menunggu"
                                        {{ $aduan->status == 'menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>

                                    <option value="diproses"
                                        {{ $aduan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>

                                    <option value="selesai"
                                        {{ $aduan->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                    <option value="ditolak"
                                        {{ $aduan->status == 'ditolak' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>

                                </select>
                                <button type="submit" class="btn btn-success btn-sm">
                                    Simpan
                                </button>

                            </div>
                        </div>




                    </form>
                </div>


            </div>

        </div>
    </div>
</div>
</div>

@endsection