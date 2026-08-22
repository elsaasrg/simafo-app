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
                    Dashboard Mahasiswa
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="content bg-content">
    <div class="container-fluid">
        <div class="row justify-content-center bg-white p-2">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Banner Selamat Datang -->
                        <div class="welcome-banner mb-5 rounded-lg bg-white mt-3">
                            <div class="card-body d-flex justify-content-between align-items-center py-2 px-3">
                                <div class="flex-grow-1">
                                    <p class="mb-0 font-weight-bold text-dark" style="font-size: 15px;">
                                        Selamat datang kembali, <span class="text-lowercase">{{ Auth::user()->name ?? 'mahasiswa' }}</span>
                                    </p>
                                </div>
                                <div>
                                    <span class="badge badge-role badge-success rounded-pill px-3 py-2 text-sm" style="background-color: #2da44e !important; border-radius: 20px;">
                                        Mahasiswa Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8">
                        <!-- Grid Menu Utama (2 Kolom) -->
                        <div class="row text-center text-md-left mb-3">
                            <div class="col-12">
                                <h4 class="font-weight-bold m-0">LAYANAN MAHASISWA</h4>
                            </div>
                        </div>
                        <div class="row text-center mt-3">
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


                            <div class="col-12 col-md-6 mb-5">
                                <a href="{{ route('organisasi.index') }}" class="text-decoration-none menu-item-link">
                                    <div class="folder-wrapper">
                                        <div class="folder-back"></div>
                                        <div class="folder-front">
                                            <i class="fas fa-users fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold text-dark menu-title mt-2">Data Organisasi</span>
                                </a>
                            </div>

                            <!-- 3. Aduan Mahasiswa -->
                            <div class="col-12 col-md-6 mb-5">
                                <a href="{{ route('beasiswa.index') }}" class="text-decoration-none menu-item-link">
                                    <div class="folder-wrapper">
                                        <div class="folder-back"></div>
                                        <div class="folder-front">
                                            <i class="fas fa-graduation-cap fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold text-dark menu-title mt-2">Data Beasiswa</span>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 mb-5">
                                <a href="{{ route('konseling.index') }}" class="text-decoration-none menu-item-link">
                                    <div class="folder-wrapper">
                                        <div class="folder-back"></div>
                                        <div class="folder-front">
                                            <i class="fas fa-comments fa-3x text-primary"></i>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold text-dark menu-title mt-2">Konseling</span>
                                </a>
                            </div>

                            <!-- 5. Data Beasiswa Mahasiswa -->
                            <div class="col-12 col-md-6 mb-5">
                                <a href="{{ route('aduan.index') }}" class="text-decoration-none menu-item-link">
                                    <div class="folder-wrapper">
                                        <div class="folder-back"></div>
                                        <div class="folder-front">
                                            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold text-dark menu-title mt-2">Aduan</span>
                                </a>
                            </div>

                            <!-- 6. Tracer Study -->
                            <div class="col-12 col-md-6 mb-5">
                                <a href="{{ route('pengajuan-surat.index') }}" class="text-decoration-none menu-item-link">
                                    <div class="folder-wrapper">
                                        <div class="folder-back"></div>
                                        <div class="folder-front">
                                            <i class=" fas fa-file-alt fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold text-dark menu-title mt-2">Pengajuan Surat</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-outline-yellow shadow-sm p-0">
                            <div class="card-header bg-white p-2">
                                <h5 class="font-weight-bold mb-0 text-center">
                                    Informasi Terbaru
                                </h5>
                            </div>
                            <div class="card-body p-0">

                                @forelse($pengumumanTerbaru as $item)
                                <div class="p-3 border-bottom position-relative hover-light text-white">
                                    <span class="badge bg-green-2 text-xs float-right px-2 py-1 btn-radius">
                                        {{ $item->kategori_info }}
                                    </span>

                                    <h6 class="font-weight-bold text-dark mb-1 text-sm" style="padding-right: 85px;">
                                        @if($item->kategori_info == 'beasiswa')
                                        <a href="/info-beasiswa" class="text-dark text-decoration-none">
                                            {{ $item->nama_beasiswa }}
                                        </a>
                                        @elseif($item->kategori_info == 'lomba')
                                        <a href="/info-lomba" class="text-dark text-decoration-none">
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
                            <div class="card-header bg-light py-3">
                                <h3 class="card-title font-weight-bold text-sm"><i class="fas fa-external-link-alt mr-2"></i> Tautan Sistem & Informasi Luar</h3>
                            </div>
                            <div class="card-body p-3">

                                <div class="callout callout-info mb-3 bg-light elevation-1">
                                    <P class="font-weight-bold mb-1"><i class="fas fa-graduation-cap mr-2"></i> Portal TA (SISFOTA)</p>
                                    <p class="text-xs text-muted mb-2">Kelola pendaftaran proposal dan tugas akhir.</p>
                                    <a href="https://sisfota.fmipa-untan.id/" target="_blank" class="btn btn-sm bg-yellow-4 btn-block font-weight-bold no-underline btn-radius">BUKA WEB SISFOTA</a>
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
    </div>
</div>
@endsection