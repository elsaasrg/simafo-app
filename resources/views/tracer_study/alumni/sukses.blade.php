@extends('layouts.app')

@section('content')
<style>
    /* CSS Khusus Cetak: Menyembunyikan komponen web yang tidak penting saat dicetak */
    @media print {

        /* Sembunyikan navbar/sidebar bawaan layouts.app, tombol aksi, dan footer */
        nav,
        .navbar,
        .sidebar,
        .btn,
        .no-print,
        footer {
            display: none !important;
        }

        /* Hilangkan background abu-abu sistem, buat warna dasar putih bersih */
        body,
        .main-panel,
        .content-wrapper {
            background: #fff !important;
            margin: 0;
            padding: 0;
        }

        /* Hilangkan bayangan box card agar rapi di kertas */
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            margin-top: 20px;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow border-0 p-4">
                <div class="card-body text-center">

                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-4x mb-3 no-print"></i>
                        <h2 class="font-weight-bold text-success mb-1">TERIMA KASIH SUDAH MENGISI</h2>
                        <p class="text-muted">Data Tracer Study Alumni Sistem Informasi UNTAN</p>
                    </div>

                    <hr class="my-4">

                    <div class="text-left bg-light p-4 rounded mb-4" style="text-align: left !important; background-color: #f8f9fa !important; border: 1px id #eee;">
                        <h5 class="font-weight-bold text-dark mb-3 text-center">BUKTI PENGISIAN DATA</h5>
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td style="width: 35%;"><strong>Nama Mahasiswa</strong></td>
                                <td style="width: 3%;">:</td>
                                <td>{{ $mahasiswa->user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIM</strong></td>
                                <td>:</td>
                                <td>{{ $mahasiswa->nim }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Isi</strong></td>
                                <td>:</td>
                                <td>{{ date('d F Y, H:i') }} WIB</td>
                            </tr>
                            <!-- <tr>
                                <td><strong>Keperluan</strong></td>
                                <td>:</td>
                                <td><span class="text-danger font-weight-bold">Syarat Pendaftaran Wisuda</span></td>
                            </tr> -->
                        </table>
                    </div>

                    <p class="small text-muted mb-4">
                        *Simpan halaman ini dalam bentuk cetak kertas atau simpan sebagai PDF sebagai bukti bahwa Anda telah menyelesaikan kewajiban pengisian kuisioner.*
                    </p>

                    <div class="d-flex justify-content-center gap-2 no-print">
                        <button onclick="window.print();" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-print mr-1"></i> Cetak Tampilan Ini
                        </button>
                        <a href="{{ route('tracer-study.index') }}" class="btn btn-outline-secondary px-4">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection