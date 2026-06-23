@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="font-weight-bold text-purple">
                <i class="fas fa-th-large mr-2"></i> Dashboard Admin
            </h4>

        </div>
    </div>

    <!-- ================= SECTION 1: ANTRIAN VALIDASI (REKAM JEJAK KEGIATAN) ================= -->
    <div class="row mb-4">

        <!-- Aktivitas dan Prestasi -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-danger text-white">
                <div class="card-body">

                    <h6>Total Aktivitas & Prestasi</h6>

                    <h2>
                        {{ $totalAktivitas }}
                    </h2>

                </div>
            </div>
        </div>

        <!-- Organisasi -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-success text-white">
                <div class="card-body">

                    <h6>Total Data Organisasi</h6>

                    <h2>
                        {{ $totalOrganisasi }}
                    </h2>

                </div>
            </div>
        </div>

        <!-- Aduan -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-secondary text-white">
                <div class="card-body">

                    <h6>Total Data Aduan</h6>

                    <h2>
                        {{ $totalAduan }}
                    </h2>

                </div>
            </div>
        </div>

        <!-- D -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-purple text-white">
                <div class="card-body">

                    <h6>Total Data Beasiswa </h6>

                    <h2>
                        {{ $totalBeasiswa }}
                    </h2>

                </div>
            </div>
        </div>





        <!-- Data Beasiswa -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-warning text-white">
                <div class="card-body">

                    <h6>Total Tracer Study</h6>

                    <h2>
                        {{ $totalTracerStudy }}
                    </h2>

                </div>
            </div>
        </div>


        <!-- Pengajuan Surat -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm bg-primary text-white">
                <div class="card-body">

                    <h6>Pengajuan Surat</h6>

                    <h2>
                        {{ $totalPengajuanSurat }}
                    </h2>

                </div>
            </div>
        </div>

    </div>



    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Status Aduan
                </div>
                <div class="card-body">
                    <p>
                        Menunggu :
                        <span class="badge bg-secondary">
                            {{ $aduanMenunggu }}
                        </span>
                    </p>
                    <p>
                        Diproses :
                        <span class="badge bg-warning">
                            {{ $aduanDiproses }}
                        </span>
                    </p>
                    <p>
                        Selesai :
                        <span class="badge bg-success">
                            {{ $aduanSelesai }}

                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Status Aktivitas dan Prestasi
                </div>
                <div class="card-body">
                    <p>
                        Menunggu :
                        <span class="badge bg-secondary">
                            {{ $aktivitasMenunggu }}
                        </span>
                    </p>
                    <p>
                        Diproses :
                        <span class="badge bg-warning">
                            {{ $aktivitasDiproses }}
                        </span>
                    </p>
                    <p>
                        Selesai :
                        <span class="badge bg-success">
                            {{ $aktivitasSelesai }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Status Data Organisasi
                </div>
                <div class="card-body">
                    <p>
                        Menunggu :
                        <span class="badge bg-secondary">
                            {{ $organisasiMenunggu }}
                        </span>
                    </p>
                    <p>
                        Diproses :
                        <span class="badge bg-warning">
                            {{ $organisasiDiproses }}
                        </span>
                    </p>
                    <p>
                        Selesai :
                        <span class="badge bg-success">
                            {{ $organisasiSelesai }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Status Data Beasiswa
                </div>
                <div class="card-body">
                    <p>
                        Menunggu :
                        <span class="badge bg-secondary">
                            {{ $beasiswaMenunggu }}
                        </span>
                    </p>
                    <p>
                        Diproses :
                        <span class="badge bg-warning">
                            {{ $beasiswaDiproses }}
                        </span>
                    </p>
                    <p>
                        Selesai :
                        <span class="badge bg-success">
                            {{ $beasiswaSelesai }}
                        </span>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Status Pengajuan Surat
                </div>
                <div class="card-body">
                    <p>
                        Menunggu :
                        <span class="badge bg-secondary">
                            {{ $pengajuanSuratMenunggu }}
                        </span>
                    </p>
                    <p>
                        Diproses :
                        <span class="badge bg-warning">
                            {{ $pengajuanSuratDiproses }}
                        </span>
                    </p>
                    <p>
                        Selesai :
                        <span class="badge bg-success">
                            {{ $pengajuanSuratSelesai }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-header">
                    Pengajuan Surat Terbaru
                </div>

                <div class="card-body">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Jenis Surat</th>
                                <th>Mahasiswa</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pengajuanSuratTerbaru as $item)

                            <tr>

                                <td>
                                    {{ $item->jenis_surat }}
                                </td>
                                <td>
                                    {{ $item->mahasiswa->user->name }}
                                </td>
                                <td>
                                    {{ $item->keperluan }}
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="3"
                                    class="text-center">

                                    Belum ada aduan

                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


</div>

<!-- Gaya Khusus CSS Pendukung agar Dashboard Mirip SIMAFO di image_c9267e.png -->
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

    .border-left-purple {
        border-left: 4px solid #6f42c1 !important;
    }

    .border-left-info {
        border-left: 4px solid #17a2b8 !important;
    }

    .border-left-success {
        border-left: 4px solid #28a745 !important;
    }

    .border-left-danger {
        border-left: 4px solid #dc3545 !important;
    }

    .border-left-dark {
        border-left: 4px solid #343a40 !important;
    }

    .action-card {
        transition: all 0.2s ease-in-out;
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12) !important;
    }

    .opacity-50 {
        opacity: 0.5;
    }

    .opacity-75 {
        opacity: 0.75;
    }
</style>
@endsection