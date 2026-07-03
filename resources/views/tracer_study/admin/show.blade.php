@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header ">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Rincian Tracer Study</div>
                    <div><a href="{{ route('tracer-study.index') }}" class="btn btn-primary btn-sm">Kembali</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Nama Alumni</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->mahasiswa->user->name }}</div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>NIM</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->mahasiswa->nim }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Tahun Lulus</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->mahasiswa->tahun_lulus }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Status Saat Ini</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->status_saat_ini }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Masa Tunggu</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->masa_tunggu }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Nama Pekerjaan</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->nama_pekerjaan }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Lokasi Kerja</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->lokasi_kerja }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Gaji</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->gaji }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Tingkat Kesesuaian</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->tingkat_kesesuaian }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Program Studi Lanjut</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->program_studi_lanjut }}</div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 text-md-end text-start"><strong>Institusi Studi Lanjut</strong></label>
                    <div class="col-md-6">{{ $tracerStudy->institusi_studi_lanjut }}</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection