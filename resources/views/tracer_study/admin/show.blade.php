@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 mt-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold mb-1">Detail Tracer Study Alumni</h1>

        </div>

    </div>

    {{-- BIODATA ALUMNI --}}
    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            Biodata Alumni
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Nama Alumni</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->mahasiswa->user->name ?? ($tracerStudy->mahasiswa->nama ?? '-') }}</dd>

                <dt class="col-sm-4">NIM</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->mahasiswa->nim ?? '-' }}</dd>

                <dt class="col-sm-4">Tahun Kelulusan</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->mahasiswa->tahun_lulus ?? '-' }}</dd>
            </dl>
        </div>
    </div>

    {{-- DETAIL KUESIONER --}}
    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            Hasil Kuesioner
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                {{-- Status Utama --}}
                <dt class="col-sm-4">1. Status Kegiatan Utama Saat Ini</dt>
                <dd class="col-sm-8">: {{ str_replace('_', ' ', $tracerStudy->status_saat_ini ?? 'Belum Diisi') }}</dd>

                <dt class="col-12">
                    <hr>
                </dt>

                {{-- Riwayat Pekerjaan / Wirausaha --}}
                <dt class="col-sm-4">2. Masa Tunggu Kerja</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->masa_tunggu ?? '-' }}</dd>

                <dt class="col-sm-4">3. Nama Pekerjaan / Jabatan</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->nama_pekerjaan ?? '-' }}</dd>

                <dt class="col-sm-4">4. Lokasi Kerja</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->lokasi_kerja ?? '-' }}</dd>

                <dt class="col-sm-4">5. Rata-rata Gaji Per Bulan</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->gaji ? 'Rp ' . number_format($tracerStudy->gaji, 0, ',', '.') : '-' }}</dd>

                <dt class="col-sm-4">6. Tingkat Kesesuaian Prodi</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->tingkat_kesesuaian ? 'Skala ' . $tracerStudy->tingkat_kesesuaian . ' / 5' : '-' }}</dd>

                <dt class="col-sm-4">7. Sektor Tempat Kerja</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->sektor_kerja ? ucwords(str_replace('_', ' ', $tracerStudy->sektor_kerja)) : '-' }}</dd>

                <dt class="col-sm-4">8. Metode Cari Kerja</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->metode_cari_kerja ?? '-' }}</dd>

                <dt class="col-12">
                    <hr>
                </dt>

                {{-- Pendidikan Lanjut --}}
                <dt class="col-sm-4">9. Program Studi Lanjut</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->program_studi_lanjut ?? '-' }}</dd>

                <dt class="col-sm-4">10. Universitas / Institusi</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->institusi_studi_lanjut ?? '-' }}</dd>

                <dt class="col-sm-4">11. Sumber Dana Studi</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->sumber_dana_studi ? ucwords(str_replace('_', ' ', $tracerStudy->sumber_dana_studi)) : '-' }}</dd>

                <dt class="col-12">
                    <hr>
                </dt>

                {{-- Masukan --}}
                <dt class="col-sm-4">12. Masukan untuk Prodi</dt>
                <dd class="col-sm-8">: {{ $tracerStudy->saran_perbaikan ?? '-' }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection