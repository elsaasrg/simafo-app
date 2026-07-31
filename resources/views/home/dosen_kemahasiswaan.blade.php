@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-12 text-center">
                <h4 class="m-0 text-dark font-weight-bold text-uppercase tracking-wide">
                    Dashboard Dosen Kemahasiswaan
                </h4>
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
                                Selamat datang kembali, <span class="text-lowercase">{{ Auth::user()->name ?? 'dosen kemahasiswaan' }}</span>
                            </p>
                        </div>
                        <div>
                            <span class="badge badge-role badge-success rounded-pill px-3 py-2 text-sm" style="background-color: #2da44e !important; border-radius: 20px;">
                                Dosen Kemahasiswaan
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Grid Menu Utama  -->
                <div class="row text-center mt-4">

                    <!-- 1. info lomba -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="/info-lomba" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-trophy fa-2x text-purple mb-2"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Kelola Informasi Lomba</span>
                        </a>
                    </div>

                    <!-- 2. infobeasiswa  -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="info-beasiswa" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-briefcase fa-2x text-danger mb-2"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Kelola Informasi Beasiswa</span>
                        </a>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection