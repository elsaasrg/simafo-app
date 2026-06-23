@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- KANAN UTAMA: Dashboard Selamat Datang -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white font-weight-bold text-dark border-bottom-0 pt-3">
                    <i class="fas fa-graduation-cap mr-2 text-primary"></i>{{ __('Halaman Alumni') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success shadow-sm" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    </div>
                    @endif

                    <h5 class="font-weight-bold text-dark mb-1">Selamat datang kembali, {{ Auth::user()->name }}!</h5>
                    <p class="text-muted text-sm">Di Halaman Alumni Sistem Informasi Universitas Tanjungpura</p>

                    <hr class="my-3">

                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-primary btn-sm rounded-pill px-3 font-weight-bold shadow-sm" href="{{ route('tracer-study.index') }}">
                            <i class="fas fa-poll-h mr-1"></i> Tracer Study
                        </a>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<style>
    .text-indigo {
        color: #3f51b5 !important;
    }

    .btn-indigo:hover {
        background-color: #2c3b8c !important;
    }

    .hover-light:hover {
        background-color: #f8f9fa;
        border-radius: 4px;
        transition: background 0.2s;
    }
</style>
@endsection