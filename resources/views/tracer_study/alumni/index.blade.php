@extends('layouts.app')

@section('content')

<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3 text-center">
                    <h5 class="mb-0 ">Dashboard Tracer Study</h5>
                </div>
                <div class="card-body p-4 text-center">

                    <p class="mb-3 font-weight-bold">Halo, {{ auth()->user()->name }}!</p>
                    @if(!$tracerstudy)
                    <div class="alert alert-warning border-0 shadow-sm mb-4 bg-kuning-6 btn-radius text-white" role="alert">
                        Anda belum mengisi kuesioner Tracer Study.
                    </div>
                    <a href="{{ route('tracer-study.create') }}" class="btn btn-primary btn-lg px-4 shadow">
                        <i class="fas fa-edit me-2"></i> Isi Tracer Study Sekarang
                    </a>
                    @else
                    <p class="text-muted mb-4">Terima kasih telah berpartisipasi dalam pengisian tracer study.</p>

                    <div class="alert alert-success border-0 shadow-sm mb-4 bg-hijau-1 btn-radius" role="alert">
                        <i class="fas fa-check-circle me-2 text-success"></i> Anda telah berhasil mengisi Tracer Study.
                    </div>

                    <div class="card bg-light border-0 p-3 mb-4 text-start">
                        <h6 class="fw-bold mb-3">Ringkasan Data Anda:</h6>
                        <p class="mb-2"><strong>Status Saat Ini:</strong> {{ $tracerstudy->status_saat_ini }}</p>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('tracer-study.show', $tracerstudy->id) }}" class="btn bg-yellow-4 text-white px-3 btn-radius">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </a>


                        <a href="{{ route('tracer-study.sukses') }}" class="btn bg-green-2 text-white px-3 btn-radius mx-1">
                            <i class="fas fa-print me-1"></i> Cetak Bukti Pengisian
                        </a>

                        <a href="{{ route('tracer-study.edit', $tracerstudy->id) }}" class="btn bg-yellow-6 text-white px-3 btn-radius">
                            <i class="fas fa-pencil-alt me-1"></i> Edit Jawaban
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection