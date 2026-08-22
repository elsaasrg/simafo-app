@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h4 class="m-0 text-dark font-weight-bold text-uppercase tracking-wide">
                    DASHBOARD ADMIN
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="content bg-content">
    <div class="container-fluid">
        <div class="row justify-content-center bg-white p-3">
            <div class="col-12">

                <!-- Grid Menu Utama (4 Kolom per Baris di Desktop) -->
                <div class="row text-center mt-4 ">

                    <div class="col-12 col-md-6 col-lg-3 mb-5 ">
                        <a href="{{ route('aktivitas.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalAktivitas }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Total Data Aktivitas Dan Prestasi</span>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <a href="{{ route('organisasi.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalOrganisasi }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Total Data Organisasi</span>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <a href="{{ route('aduan.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalAduan }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Total Data Aduan</span>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <a href="{{ route('beasiswa.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalBeasiswa }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Total Data Beasiswa</span>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <a href="{{ route('tracer-study.index') }}" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalTracerStudy }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Total Tracer Study</span>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <a href="/pengajuan-surat" class="text-decoration-none menu-item-link">
                            <div class="folder-wrapper">
                                <div class="folder-back"></div>
                                <div class="folder-front">
                                    <div class="folder-count">
                                        <div class="d-flex justify-content-end w-100 p-2  mt-2 px-4">
                                            <h4 class="border-yellow-2 px-3 py-2 btn-radius text-dark"><strong>{{ $totalPengajuanSurat }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="d-block font-weight-bold text-dark menu-title mt-2">Pengajuan Surat</span>
                        </a>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3 d-flex">
                    <div class="card shadow-sm w-100 ">
                        <div class="card-header">
                            Status Aduan
                        </div>
                        <div class="card-body">
                            <p>
                                Menunggu :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aduanMenunggu }}
                                </span>
                            </p>
                            <p>
                                Diproses :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aduanDiproses }}
                                </span>
                            </p>
                            <p>
                                Selesai :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aduanSelesai }}
                                </span>
                            </p>
                            <p>
                                Ditolak :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aduanDitolak }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-header">
                            Status Aktivitas dan Prestasi
                        </div>
                        <div class="card-body">
                            <p>
                                Menunggu :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aktivitasMenunggu }}
                                </span>
                            </p>
                            <p>
                                Valid :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aktivitasValid }}
                                </span>
                            </p>
                            <p>
                                Tidak Valid :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $aktivitasTidakValid }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-header">
                            Status Data Organisasi
                        </div>
                        <div class="card-body">
                            <p>
                                Menunggu :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $organisasiMenunggu }}
                                </span>
                            </p>
                            <p>
                                Diterima :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $organisasiDiterima }}
                                </span>
                            </p>
                            <p>
                                Ditolak :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $organisasiDitolak }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-header">
                            Status Data Beasiswa
                        </div>
                        <div class="card-body">
                            <p>
                                Menunggu :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $beasiswaMenunggu }}
                                </span>
                            </p>
                            <p>
                                Diterima :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $beasiswaDiterima }}
                                </span>
                            </p>
                            <p>
                                Ditolak :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $beasiswaDitolak }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-3 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-header">
                            Status Pengajuan Surat
                        </div>
                        <div class="card-body">
                            <p>
                                Menunggu :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $pengajuanSuratMenunggu }}
                                </span>
                            </p>
                            <p>
                                Diproses :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $pengajuanSuratDiproses }}
                                </span>
                            </p>
                            <p>
                                Selesai :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $pengajuanSuratSelesai }}
                                </span>
                            </p>
                            <p>
                                Ditolak :
                                <span class="badge bg-yellow-1 p-2 btn-radius">
                                    {{ $pengajuanSuratDitolak }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 p-3">

                <div class="card shadow-sm w-100">

                    <div class="card-header text-center font-weight-bold">
                        Pengajuan Surat Terbaru
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
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

                                            Belum ada pengajuan surat

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




    </div>
</div>
@endsection