@extends('layouts.app')

@section('content')
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
                    <div class="col-md-4 text-md-end"><strong>Nama Dosen:</strong></div>
                    <div class="col-md-6">{{ $konseling->dosen->nama_lengkap }}</div>
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
                @if($konseling->tanggapan_dosen)
                <div class="mb-3 row">
                    <div class="col-md-4 text-md-end"><strong>Tanggapan dosen:</strong></div>
                    <div class="col-md-6">{{ $konseling->tanggapan_dosen }}</div>
                </div>
                @endif



            </div>
        </div>
    </div>
</div>

@endsection