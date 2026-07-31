@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-12 text-center">
                <h3 class="m-0 text-dark font-weight-bold text-uppercase tracking-wide">
                    <i class="fas fa-th-large mr-2"></i>Dashboard Alumni
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="content bg-content">
    <div class="container-fluid">
        <div class="row justify-content-center bg-white p-2">

            <div class="col-12 ">

                <!-- Banner Selamat Datang -->
                <div class="welcome-banner mb-5 rounded-lg bg-white mt-3">
                    <div class="card-body d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="flex-grow-1">
                            <p class="mb-0 font-weight-bold text-dark" style="font-size: 15px;">
                                Selamat datang kembali, <span class="text-lowercase">{{ Auth::user()->name ?? 'Alumni'}}</span>
                            </p>
                        </div>
                        <div>
                            <span class="badge badge-role badge-success rounded-pill px-3 py-2 text-sm" style="background-color: #2da44e !important; border-radius: 20px;">
                                Alumni
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Grid Menu Utama (2 Kolom) -->
                <div class="row text-center mt-4">

                    <!-- Tracer Study -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('tracer-study.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-briefcase fa-3x text-info"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Tracer Study</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection