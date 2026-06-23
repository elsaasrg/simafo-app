@extends('layouts.app')

@section('content')

{{ $errors }}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">Dashboard Tracer Study</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <h4 class="mb-2">Halo, {{ $mahasiswa->user->name }}!</h4>
                    <p class="text-muted mb-4">Terima kasih telah berpartisipasi dalam pengisian pelacakan alumni.</p>

                    @if(!$tracerstudy)
                    <div class="alert alert-warning border-0 shadow-sm mb-4" role="alert">
                        Anda belum mengisi kuisioner Tracer Study tahun ini.
                    </div>
                    <a href="{{ route('tracer-study.create') }}" class="btn btn-primary btn-lg px-4 shadow">
                        <i class="fas fa-edit me-2"></i> Isi Tracer Study Sekarang
                    </a>
                    @else
                    <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> Anda telah berhasil mengisi Tracer Study.
                    </div>

                    <div class="card bg-light border-0 p-3 mb-4 text-start">
                        <h6 class="fw-bold mb-3">Ringkasan Data Anda:</h6>
                        <p class="mb-2"><strong>Status Saat Ini:</strong> {{ $tracerstudy->status_saat_ini }}</p>
                        @if($tracerstudy->nama_pekerjaan)
                        <p class="mb-0"><strong>Pekerjaan:</strong> {{ $tracerstudy->nama_pekerjaan }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('tracer-study.show', $tracerstudy->id) }}" class="btn btn-info text-white px-3">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </a>
                        <a href="{{ route('tracer-study.edit', $tracerstudy->id) }}" class="btn btn-warning text-white px-3">
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