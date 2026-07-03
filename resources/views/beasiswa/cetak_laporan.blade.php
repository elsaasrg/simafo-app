<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap Beasiswa Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* CSS Khusus agar pas dicetak rapi dan tombol aksi menghilang */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                padding: 0;
                background-color: #fff;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .ttd-wrapper {
                page-break-inside: avoid;
            }
        }

        /* Desain Kop Surat */
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-univ {
            width: 90px;
            height: auto;
        }

        .judul-laporan {
            font-weight: bold;
            text-decoration: underline;
            letter-spacing: 0.5px;
        }

        .table-laporan th,
        .table-laporan td {
            font-size: 11px;
            padding: 6px !important;
            vertical-align: middle !important;
        }

        /* CSS untuk mengatur posisi tanda tangan di sebelah kanan bawah dan jaraknya */
        .ttd-wrapper {
            display: flex;
            justify-content: flex-end;
            /* Memaksa kotak tanda tangan bergeser penuh ke kanan */
            margin-top: 50px;
            /* Jarak pembatas dari tabel di atasnya */
            padding-right: 30px;
            /* Jarak aman dari pinggir kanan kertas */
            font-size: 13px;
            width: 100%;
        }

        .ttd-box {
            text-align: center;
            /* Membuat susunan teks di dalam box tetap rata tengah simetris */
            width: 260px;
            /* Lebar proporsional box tanda tangan */
        }

        .ttd-space {
            height: 80px;
            /* Jarak ruang kosong yang diperlebar khusus untuk space tanda tangan */
        }
    </style>
</head>

<body class="bg-light">

    {{-- Navigasi Tombol Kembali & Cetak --}}
    <div class="container mt-3 no-print">
        <div class="d-flex justify-content-between align-items-center p-2 bg-white rounded shadow-sm mb-3">
            <a href="javascript:history.back()" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
            </a>
            <button onclick="window.print()" class="btn btn-sm btn-primary">
                <i class="fas fa-print mr-1"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    {{-- Kertas Utama Laporan --}}
    <div class="container bg-white p-4 my-3 shadow-sm card">

        {{-- Kop Surat Resmi --}}
        <div class="row kop-surat align-items-center">
            <div class="col-2 text-right">
                <img src="{{ asset('images/logo_untan.png') }}" class="logo-univ" alt="Logo Untan">
            </div>
            <div class="col-10 text-center pr-5">
                <h5 class="mb-0 font-weight-bold" style="font-size: 16px;">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h5>
                <h4 class="mb-0 font-weight-bold" style="font-size: 18px;">UNIVERSITAS TANJUNGPURA</h4>
                <p class="mb-0 small text-muted">Jl. Prof. Dr. H. Hadari Nawawi Pontianak 78124</p>
                <p class="mb-0 small text-muted">Telp/Fax: (0561) 739630 Surel: untan_59@untan.ac.id | Laman: https://untan.ac.id</p>
            </div>
        </div>

        {{-- Judul Dokumen Laporan --}}
        <div class="text-center my-3">
            <h5 class="judul-laporan" style="font-size: 15px;">LAPORAN REKAP DATA BEASISWA MAHASISWA</h5>
        </div>

        {{-- Metadata Laporan / Filter Informasi --}}
        <div class="row small mb-3">
            <div class="col-6">
                <table class="table table-borderless table-sm m-0">
                    <tr>
                        <td width="35%"><strong>Status Validasi</strong></td>
                        <td width="5%">:</td>
                        <td>
                            @if(request('status') == 'diterima')
                            <span class="text-success font-weight-bold">Diterima</span>
                            @elseif(request('status') == 'menunggu')
                            <span class="text-warning font-weight-bold">Menunggu</span>
                            @elseif(request('status') == 'ditolak')
                            <span class="text-danger font-weight-bold">Ditolak</span>
                            @else
                            <span class="text-muted">Semua Status</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Kata Kunci Pencarian</strong></td>
                        <td>:</td>
                        <td><span class="font-style: italic;">{{ request('search') ? '"'.request('search').'"' : '-' }}</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless table-sm m-0">
                    <tr>
                        <td width="40%"><strong>Kategori Tahun Filter</strong></td>
                        <td width="5%">:</td>
                        <td><span class="font-weight-bold">{{ request('tahun') && request('tahun') != 'semua' ? request('tahun') : 'Semua Tahun' }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Cetak Laporan</strong></td>
                        <td>:</td>
                        {{-- Jam/Waktu sudah dihapus dari format tanggal cetak --}}
                        <td>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Tabel Data Beasiswa --}}
        <div class="table-responsive">
            <table class="table table-bordered table-laporan text-center table-striped">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Nama Beasiswa</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beasiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left pl-2">{{ $item->mahasiswa->user->name }}</td>
                        <td>{{ $item->mahasiswa->nim }}</td>
                        <td class="text-left pl-2">
                            {{ $item->nama_beasiswa }}
                            @if($item->catatan_admin)
                            <br><small class="text-danger font-italic">Catatan: {{ $item->catatan_admin }}</small>
                            @endif
                        </td>
                        <td class="text-left pl-2">{{ $item->penyelenggara }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                        <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') : '-' }}</td>
                        <td>
                            @if($item->status_validasi == 'diterima')
                            <span class="text-success font-weight-bold">Diterima</span>
                            @elseif($item->status_validasi == 'menunggu')
                            <span class="text-warning font-weight-bold">Menunggu</span>
                            @else
                            <span class="text-danger font-weight-bold">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted font-italic py-4">
                            Tidak ada data beasiswa yang tersedia atau sesuai kriteria filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BAGIAN TANDA TANGAN DI SEBELAH KANAN BAWAH --}}
        <div class="ttd-wrapper">
            <div class="ttd-box">
                <p class="mb-0">Pontianak, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="mb-0 font-weight-bold">Ketua Jurusan,</p>

                <div class="ttd-space"></div>

                <p class="mb-0 font-weight-bold" style="text-decoration: underline;">Renny Puspita Sari, S.T., M.T.</p>
                <p class="mb-0 text-muted" style="font-size: 12px;">NIP. 198704182015042001</p>
            </div>
        </div>
    </div>

</body>

</html>