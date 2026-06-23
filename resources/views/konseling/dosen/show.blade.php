@extends('layouts.app')

@section('content')

{{ $errors }}
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="float-start">Data Konseling</div>
                    <div class="float-end"><a href="{{ route('konseling.index') }}" class="btn btn-primary btn-sm">&larr; Back</a></div>
                </div>

            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Nama Mahasiswa:</strong></div>
                    <div class="col-md-6">{{ $konseling->mahasiswa->user->name }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Subjek:</strong></div>
                    <div class="col-md-6">{{ $konseling->subjek }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Isi Konseling:</strong></div>
                    <div class="col-md-6">{{ $konseling->isi_konseling }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Status:</strong></div>
                    <div class="col-md-6"><span class="badge bg-primary">{{ $konseling->status }}</span></div>
                </div>
                <div class="mb-3 row">

                    <form action="{{ route('konseling.update', $konseling->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <div class="col-md-4 text-md-end">
                                <label for="tanggapan_dosen" class="fw-bold">
                                    Berikan Tanggapan / Solusi:
                                </label>
                            </div>

                            <div class="col-md-6">

                                @if($konseling->tanggapan_dosen)

                                <div class="border rounded p-3 bg-light">
                                    {{ $konseling->tanggapan_dosen }}
                                </div>

                                @else

                                <textarea
                                    name="tanggapan_dosen"
                                    id="tanggapan_dosen"
                                    class="form-control @error('tanggapan_dosen') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Tuliskan saran, solusi, atau jadwal pertemuan tatap muka di sini..."
                                    required>{{ old('tanggapan_dosen') }}</textarea>

                                @error('tanggapan_dosen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">
                                        Kirim Tanggapan
                                    </button>
                                </div>

                                @endif

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