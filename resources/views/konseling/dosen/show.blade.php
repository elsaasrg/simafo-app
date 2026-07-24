@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">

            {{-- Header Card --}}
            <div class="card-header bg-white border-bottom-0">
                <h4 class="font-weight-bold text-center text-dark m-0">DATA KONSELING</h4>
            </div>
            <hr>
            {{-- Body Card --}}
            <div class="card-body px-4 py-3">

                {{-- Nama Mahasiswa --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-md-3 font-weight-bold text-dark">Nama Mahasiswa</div>
                    <div class="col-md-9 d-flex">
                        <span class="mr-2">:</span>
                        <span>{{ $konseling->mahasiswa->user->name ?? '-' }}</span>
                    </div>
                </div>

                {{-- Subjek --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-md-3 font-weight-bold text-dark">Subjek</div>
                    <div class="col-md-9 d-flex">
                        <span class="mr-2">:</span>
                        <span>{{ $konseling->subjek }}</span>
                    </div>
                </div>

                {{-- Isi Konseling --}}
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold text-dark">Isi Konseling</div>
                    <div class="col-md-9 d-flex">
                        <span class="mr-2">:</span>
                        <div class="text-justify">{!! nl2br(e($konseling->isi_konseling)) !!}</div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 font-weight-bold text-dark">Status</div>
                    <div class="col-md-9 d-flex align-items-center">
                        <span class="mr-2">:</span>
                        <span class="badge badge-primary bg-primary px-2 font-weight-normal btn-radius">
                            {{ $konseling->status }}
                        </span>
                    </div>
                </div>



                {{-- Form / Display Tanggapan Dosen --}}
                <form action="{{ route('konseling.update', $konseling->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold text-dark">
                            <label for="tanggapan_dosen" class="m-0">Berikan Tanggapan / Solusi</label>
                        </div>
                        <div class="col-md-9 d-flex">
                            <span class="mr-2">:</span>
                            <div class="w-100">
                                @if($konseling->tanggapan_dosen)
                                <div class="border rounded p-3 bg-light text-dark">
                                    {!! nl2br(e($konseling->tanggapan_dosen)) !!}
                                </div>
                                @else
                                <textarea
                                    name="tanggapan_dosen"
                                    id="tanggapan_dosen"
                                    class="form-control @error('tanggapan_dosen') is-invalid @enderror btn-radius"
                                    rows="4"
                                    required>{{ old('tanggapan_dosen') }}</textarea>

                                @error('tanggapan_dosen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                {{-- Tombol Kirim di Pojok Kanan Bawah --}}
                            </div>


                        </div>
                    </div>
                    <div class="row mb-3 offset-md-3">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success px-2 btn-radius btn-sm">
                                Kirim Tanggapan
                            </button>
                        </div>
                    </div>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>
@endsection