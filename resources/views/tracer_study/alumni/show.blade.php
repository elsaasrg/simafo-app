@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    {{-- Header Judul & Breadcrumb --}}
    <h1 class="mt-4 font-weight-bold text-dark" style="font-size: 1.8rem;">Detail Tracer Study Alumni</h1>
    <ol class="breadcrumb mb-4 bg-light p-2 rounded small">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item active">Detail Kuesioner</li>
    </ol>

    {{-- 1. BAGIAN ATAS: BIODATA ALUMNI --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-dark text-white py-2 font-weight-bold">
            <i class="fas fa-id-card mr-1"></i> Biodata Alumni
        </div>
        <div class="card-body p-4">
            <div class="row text-center text-md-left">
                <div class="col-md-4 mb-3 mb-md-0 border-end-md">
                    <small class="text-muted d-block font-weight-bold text-uppercase">Nama Lengkap</small>
                    <span class="h6 font-weight-bold text-dark mb-0">{{ Auth::user()->name }}</span>
                </div>
                <div class="col-md-4 mb-3 mb-md-0 border-end-md">
                    <small class="text-muted d-block font-weight-bold text-uppercase">Nomor Induk Mahasiswa (NIM)</small>
                    <span class="h6 font-weight-bold text-dark mb-0">{{ $tracerStudy->mahasiswa->nim ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block font-weight-bold text-uppercase">Tahun Kelulusan</small>
                    <span class="h6 font-weight-bold text-success mb-0">
                        <i class="fas fa-graduation-cap mr-1"></i> Lulus Tahun {{ $tracerStudy->mahasiswa->tahun_lulus ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. BAGIAN BAWAH: DATA JAWABAN KUESIONER --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-info text-white py-2 font-weight-bold">
            <i class="fas fa-file-alt mr-1"></i> Rincian Jawaban Kuesioner Anda
        </div>

        <div class="card-body p-4">
            {{-- Status Utama --}}
            <div class="mb-4 pb-3 border-bottom">
                <h6 class="font-weight-bold text-muted mb-1">1. Status Kegiatan Utama Saat Ini:</h6>
                <p class="h5 font-weight-bold text-capitalize text-dark">
                    <span class="badge badge-primary px-3 py-2 shadow-sm">
                        {{ str_replace('_', ' ', $tracerStudy->status_saat_ini) }}
                    </span>
                </p>
            </div>

            <div class="row">
                {{-- BLOK RIWAYAT PEKERJAAN / WIRAUSAHA --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 p-3 border-0 bg-light shadow-sm">
                        <div class="p-2 mb-3 bg-white rounded font-weight-bold text-success small shadow-sm">
                            <i class="fas fa-briefcase mr-1"></i> Data Pekerjaan / Wirausaha
                        </div>

                        <table class="table table-borderless table-sm mb-0 small text-dark">
                            <tr>
                                <td width="40%" class="font-weight-bold text-muted">Masa Tunggu Kerja:</td>
                                <td>{{ $tracerStudy->masa_tunggu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Nama Pekerjaan/Jabatan:</td>
                                <td>{{ $tracerStudy->nama_pekerjaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Lokasi Perusahaan:</td>
                                <td>{{ $tracerStudy->lokasi_kerja ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Rata-rata Gaji Bersih:</td>
                                <td class="font-weight-bold text-success">
                                    {{ $tracerStudy->gaji ? 'Rp ' . number_format($tracerStudy->gaji, 0, ',', '.') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Tingkat Kesesuaian:</td>
                                <td>
                                    @if($tracerStudy->tingkat_kesesuaian)
                                    <span class="badge badge-success px-2">{{ $tracerStudy->tingkat_kesesuaian }} / 5</span>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- BLOK DATA PENDIDIKAN LANJUT --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100 p-3 border-0 bg-light shadow-sm">
                        <div class="p-2 mb-3 bg-white rounded font-weight-bold text-info small shadow-sm">
                            <i class="fas fa-university mr-1"></i> Data Pendidikan Lanjut (S2/S3)
                        </div>

                        <table class="table table-borderless table-sm mb-0 small text-dark">
                            <tr>
                                <td width="40%" class="font-weight-bold text-muted">Program Studi Lanjut:</td>
                                <td>{{ $tracerStudy->program_studi_lanjut ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Nama Universitas/Institusi:</td>
                                <td>{{ $tracerStudy->institusi_studi_lanjut ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Saran Perbaikan --}}
            <div class="card p-3 border-0 bg-light mb-4 shadow-sm">
                <h6 class="font-weight-bold text-muted mb-2 small"><i class="fas fa-comment-alt mr-1"></i> Saran Perbaikan untuk Perguruan Tinggi:</h6>
                <p class="mb-0 text-dark italic bg-white p-3 rounded rounded border small shadow-sm" style="font-style: italic;">
                    "{{ $tracerStudy->saran_perbaikan ?? 'Tidak ada saran yang ditambahkan.' }}"
                </p>
            </div>

            <hr class="mt-4 mb-4">

            {{-- Tombol Kontrol Kembali dan Edit --}}
            <div class="d-flex justify-content-start">
                <a href="{{ route('home') }}" class="btn btn-secondary px-4 shadow-sm mr-2">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
                <a href="{{ route('tracer-study.edit', $tracerStudy->id) }}" class="btn btn-warning text-white px-4 shadow-sm">
                    <i class="fas fa-pencil-alt mr-1"></i> Edit Jawaban Kuesioner
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #dee2e6 !important;
        }
    }
</style>
@endsection