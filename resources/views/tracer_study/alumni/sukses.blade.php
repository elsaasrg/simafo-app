@extends('layouts.app')

@section('content')
<style>
    /* CSS Khusus Cetak: Menyembunyikan komponen web yang tidak penting saat dicetak */
    @media print {

        nav,
        .navbar,
        .sidebar,
        .btn,
        .no-print,
        footer {
            display: none !important;
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
        <div class="col-md-8">

            <div class="card shadow border-0 p-4">
                <div class="card-body text-center ">

                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-4x mb-3 no-print"></i>
                        <p class="font-weight-bold text-success mb-1">TERIMA KASIH SUDAH MENGISI</p>
                        <p>Data Tracer Study Alumni Sistem Informasi UNTAN</p>
                    </div>

                    <div class="text-left p-4 rounded mb-4 text-left bg-grey-3 border-grey-2 btn-radius">
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
                        Simpan halaman ini dalam bentuk cetak kertas atau simpan sebagai PDF sebagai bukti bahwa Anda telah menyelesaikan kewajiban pengisian kuisioner.
                    </p>

                    <div class="d-flex justify-content-starat gap-2 no-print">
                        <button onclick="window.print();" class="btn btn-sm text-dark btn-primary shadow-sm btn-radius mx-2">
                            <i class="fas fa-print mr-1"></i> <span class="text-white">Cetak Tampilan Ini<span>
                        </button>
                        <a href="{{ route('tracer-study.index') }}" class="btn btn-sm btn-secondary text-dark btn-radius">
                            <i class="fas fa-arrow-left mr-1"></i> <span class="text-white">Kembali</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection