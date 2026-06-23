@extends('layouts.app')

@section('content')

{{ $errors }}
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="float-start">Data Aduan</div>
                    <div class="float-end"><a href="{{ route('aduam.index') }}" class="btn btn-primary btn-sm">&larr; Back</a></div>
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
                    <div class="col-md-4 text-md-end"><strong>Status:</strong></div>
                    <div class="col-md-6"><span class="badge bg-primary">{{ $aduan->status }}</span></div>
                </div>
                <div class="mb-3 row">

                    <form action="{{ route('aduan.update', $aduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 text-md-end">
                                <label for="tanggapan_admin" class="fw-bold ">Berikan Tanggapan / Solusi:</label>
                            </div>
                            @if($aduan->tanggapan_admin)

                            <div class="border rounded p-3 bg-light col-md-6">
                                {{ $aduan->tanggapan_admin }}
                            </div>

                            @else
                            <div class="col-md-6">
                                <textarea
                                    name="tanggapan_admin"
                                    id="tanggapan_admin"
                                    class=" form-control mt-1 @error('tanggapan_admin') is-invalid @enderror"
                                    rows="6"
                                    placeholder="Tuliskan saran, solusi, atau jadwal pertemuan tatap muka di sini..."
                                    required>{{ old('tanggapan_admin', $aduan->tanggapan_admin) }}</textarea>

                                @error('tanggapan_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success px-4">
                            Kirim Tanggapan
                        </button>
                        @endif
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
</div>

@endsection