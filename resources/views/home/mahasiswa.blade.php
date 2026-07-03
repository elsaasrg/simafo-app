@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-purple font-weight-bold"><i class="fas fa-th-large mr-2"></i>Dashboard Mahasiswa</h1>
            </div>

        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="row mt-3">

            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">
                                Selamat datang, {{ Auth::user()->name }}
                            </p>
                        </div>

                        <div>
                            <span class="badge bg-success p-2">
                                Mahasiswa {{ auth()->user()->mahasiswa->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <h6 class="text-muted font-weight-bold mt-4 mb-3">LAYANAN MAHASISWA</h6>

                <div class="row text-center">
                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('aktivitas.index') }}" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3">
                                    <i class="fas fa-trophy fa-2x text-purple mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Data Aktivitas dan Prestasi</span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('organisasi.index') }}" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3">
                                    <i class="fas fa-graduation-cap fa-2x text-secondary mb-2"></i> <span class="d-block font-weight-bold text-dark text-sm">Data Organisasi</span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('beasiswa.index') }}" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3">
                                    <i class="fas fa-graduation-cap fa-2x text-secondary mb-2"></i> <span class="d-block font-weight-bold text-dark text-sm">Data Beasiswa</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('konseling.index') }}" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3">
                                    <i class="fas fa-comments fa-2x text-info mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Konseling</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('aduan.index') }}" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3">
                                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Aduan</span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 mb-3">
                        <a href="/pengajuan-surat" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3"> <i class="fas fa-briefcase fa-2x text-danger mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Pengajuan Surat</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="/lomba" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3"> <i class="fas fa-briefcase fa-2x text-danger mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Informasi Lomba</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="" class="text-decoration-none action-card">
                            <div class="card h-100 shadow-sm border-0  p-2">
                                <div class="card-body p-3"> <i class="fas fa-briefcase fa-2x text-danger mb-2"></i>
                                    <span class="d-block font-weight-bold text-dark text-sm">Informasi Beasiswa</span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">

                <div class="card card-purple card-outline shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-purple font-weight-bold mb-0">
                            <i class="fas fa-bullhorn mr-2"></i> Pengumuman & Info Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0">

                        @forelse($pengumumanTerbaru as $item)
                        <div class="p-3 border-bottom position-relative hover-light">
                            <span class="badge {{ $item->warna_badge }} text-xs float-right px-2 py-1">
                                {{ $item->kategori_info }}
                            </span>

                            <h6 class="font-weight-bold text-dark mb-1 text-sm" style="padding-right: 85px;">
                                @if($item->kategori_info == 'Beasiswa')
                                <a href="{{ route('beasiswa.index') }}" class="text-purple text-decoration-none">
                                    {{ $item->nama_beasiswa }}
                                </a>
                                @elseif($item->kategori_info == 'Kompetisi')
                                <a href="" class="text-danger text-decoration-none">
                                    {{ $item->nama_lomba }} </a>
                                @else

                                @endif
                            </h6>

                            <p class="text-muted mb-2 text-xs font-weight-semibold">
                                <i class="fas fa-building mr-1"></i> {{ $item->nama_perusahaan ?? $item->penyelenggara ?? 'Jurusan SI' }}
                            </p>

                            <div class="d-flex justify-content-between text-muted" style="font-size: 11px;">
                                <span><i class="far fa-clock mr-1"></i> Batas Akhir:</span>
                                <span class="text-danger font-weight-bold">
                                    {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center p-4 text-muted text-sm">
                            <i class="fas fa-info-circle fa-2x mb-2 text-secondary d-block"></i>
                            Belum ada pengumuman terbaru saat ini.
                        </div>
                        @endforelse

                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold text-secondary text-sm"><i class="fas fa-external-link-alt mr-2"></i> Tautan Sistem & Informasi Luar</h3>
                    </div>
                    <div class="card-body p-3">

                        <div class="callout callout-info mb-3 bg-light elevation-1">
                            <h6 class="font-weight-bold text-info mb-1"><i class="fas fa-graduation-cap mr-2"></i> Portal TA (SISFOTA)</h6>
                            <p class="text-xs text-muted mb-2">Kelola pendaftaran proposal dan tugas akhir.</p>
                            <a href="https://sisfota.fmipa-untan.id/" target="_blank" class="btn btn-xs btn-info btn-block text-white font-weight-bold">Buka Website SISFOTA <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>

                        <a href="https://sisfo.untan.ac.id/fasilitas" target="_blank" class="btn btn-block btn-outline-secondary text-left text-sm mb-2 font-weight-bold">
                            <i class="fas fa-university mr-2 text-purple"></i> Lihat Fasilitas Prodi SI UNTAN
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<style>
    .text-purple {
        color: #6f42c1 !important;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .card-purple.card-outline {
        border-top: 3px solid #6f42c1 !important;
    }

    .border-top-purple {
        border-top: 3px solid #6f42c1 !important;
    }

    .border-top-danger {
        border-top: 3px solid #dc3545 !important;
    }

    .border-top-info {
        border-top: 3px solid #17a2b8 !important;
    }

    .border-top-warning {
        border-top: 3px solid #ffc107 !important;
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


<style>
    .text-purple {
        color: #6f42c1 !important;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .card-purple.card-outline {
        border-top: 3px solid #6f42c1 !important;
    }

    .border-top-purple {
        border-top: 3px solid #6f42c1 !important;
    }

    .border-top-danger {
        border-top: 3px solid #dc3545 !important;
    }

    .border-top-info {
        border-top: 3px solid #17a2b8 !important;
    }

    .border-top-warning {
        border-top: 3px solid #ffc107 !important;
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