@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-12 text-center">
                <h3 class="m-0 text-dark font-weight-bold text-uppercase tracking-wide">
                    <i class="fas fa-th-large mr-2"></i>Dashboard Ketua Jurusan
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="content bg-content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12 ">

                <!-- Banner Selamat Datang -->
                <div class="card shadow-sm welcome-banner mb-5 rounded-lg bg-white mt-3">
                    <div class="card-body d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="flex-grow-1">
                            <p class="mb-0 font-weight-bold text-dark" style="font-size: 15px;">
                                Selamat datang kembali, <span class="text-lowercase">{{ Auth::user()->name ?? 'ketua jurusan' }}</span>
                            </p>
                        </div>
                        <div>
                            <span class="badge badge-role badge-success rounded-pill px-3 py-2 text-sm" style="background-color: #2da44e !important; border-radius: 20px;">
                                Ketua Jurusan Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Grid Menu Utama (2 Kolom) -->
                <div class="row text-center mt-4">

                    <!-- 1. Aktivitas dan Prestasi -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('aktivitas.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-trophy fa-3x text-warning"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Aktivitas Dan Prestasi</span>
                        </a>
                    </div>

                    <!-- 2. Konseling Mahasiswa -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('konseling.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-comments fa-3x text-primary"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Konseling Mahasiswa</span>
                        </a>
                    </div>

                    <!-- 3. Aduan Mahasiswa -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('aduan.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Aduan Mahasiswa</span>
                        </a>
                    </div>

                    <!-- 4. Data Organisasi Mahasiswa -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('organisasi.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-graduation-cap fa-3x text-dark"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Data Organisasi Mahasiswa</span>
                        </a>
                    </div>

                    <!-- 5. Data Beasiswa Mahasiswa -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="{{ route('beasiswa.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <i class="fas fa-graduation-cap fa-3x text-dark"></i>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Data Beasiswa Mahasiswa</span>
                        </a>
                    </div>

                    <!-- 6. Tracer Study -->
                    <div class="col-12 col-md-6 mb-5">
                        <a href="/tracer-study" class="text-decoration-none menu-item-link">
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

<style>
    .badge-role {
        display: inline-block;
        box-shadow: inset 2px 2px rgba(0, 0, 0, 0.3);
    }

    .bg-content {
        background-color: #EBEBEB;
    }

    .welcome-banner {
        border-radius: 15px !important;
    }

    /* Tracking / Spacing Judul */
    .tracking-wide {
        letter-spacing: 0.5px;
    }

    /* Style untuk membuat efek folder bertumpuk (Stacked Pastel Yellow Card) */
    .folder-wrapper {
        position: relative;
        width: 210px;
        height: 170px;
        margin: 0 auto;
        transition: transform 0.2s ease-in-out;
    }

    /* Lapisan Belakang Folder */
    .folder-back {
        position: absolute;
        top: 0;
        left: 0;
        width: 195px;
        height: 155px;
        background-color: #fce896;
        /* Warna kuning pastel layer belakang */
        border-radius: 16px;
    }

    /* Lapisan Depan Folder */
    .folder-front {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 195px;
        height: 155px;
        background-color: #fff2b2;
        /* Warna kuning pastel layer depan */
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
    }

    /* Font Menu Title di bagian bawah folder */
    .menu-title {
        font-size: 16px;
        color: #111111 !important;
    }

    /* Efek Hover smooth saat kursor mengarah ke menu */
    .menu-item-link:hover .folder-wrapper {
        transform: translateY(-5px);
    }

    .menu-item-link:hover .folder-front {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }
</style>
@endsection