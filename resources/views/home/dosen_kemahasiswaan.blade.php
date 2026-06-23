@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-purple font-weight-bold"><i class="fas fa-th-large mr-2"></i>Dashboard Dosen Kemahasiswaan</h1>
            </div>
        </div>
    </div>
</div>

<div class="m-4">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-0">
                    Selamat datang, {{ Auth::user()->name }}
                </p>
            </div>

            <div>
                <span class="badge bg-success p-2">
                    Dosen Kemahasiswaan
                </span>
            </div>
        </div>
    </div>

    <div class="row text-center">

        <div class="col-12 col-md-6 mb-3">
            <a href="/info-lomba" class="text-decoration-none action-card">
                <div class="card h-100 shadow-sm border-0 border-top-purple p-2">
                    <div class="card-body p-3">
                        <i class="fas fa-trophy fa-2x text-purple mb-2"></i>
                        <span class="d-block font-weight-bold text-dark text-sm">Kelola Lomba</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <a href="/info-beasiswa" class="text-decoration-none action-card">
                <div class="card h-100 shadow-sm border-0 border-top-danger p-2">
                    <div class="card-body p-3">
                        <i class="fas fa-briefcase fa-2x text-danger mb-2"></i> <span class="d-block font-weight-bold text-dark text-sm">Kelola Beasiswa</span>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    .text-purple {
        color: #6f42c1 !important;
    }

    .border-top-purple {
        border-top: 3px solid #6f42c1 !important;
    }

    .border-top-danger {
        border-top: 3px solid #dc3545 !important;
    }

    .action-card:hover .card {
        transform: translateY(-4px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.2s ease-in-out;
    }

    .action-card .card {
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection