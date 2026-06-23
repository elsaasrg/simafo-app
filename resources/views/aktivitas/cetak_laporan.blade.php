<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Prestasi Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

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
            padding: 5px !important;
            vertical-align: middle !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-3 no-print">
        <div class="d-flex justify-content-between align-items-center p-2 bg-white rounded shadow-sm mb-3">
            <a href="javascript:history.back()" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <button onclick="window.print()" class="btn btn-sm btn-primary">
                <i class="fas fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <div class="container bg-white p-4 my-3 shadow-sm card">

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

        <div class="text-center my-3">
            <h5 class="judul-laporan" style="font-size: 15px;">LAPORAN REKAP PRESTASI MAHASISWA</h5>
        </div>

        <div class="row small mb-3">
            <div class="col-6">
                <table class="table table-borderless table-sm m-0">
                    <tr>
                        <td width="35%"><strong>Program Studi</strong></td>
                        <td width="5%">:</td>
                        <td>{{ $prodi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status Validasi</strong></td>
                        <td>:</td>
                        <td>
                            @if($status == 'valid')
                            <span class="text-success font-weight-bold">Valid</span>
                            @elseif($status == 'menunggu')
                            <span class="text-warning font-weight-bold">Menunggu</span>
                            @elseif($status == 'tidak_valid')
                            <span class="text-danger font-weight-bold">Tidak Valid</span>
                            @else
                            <span class="text-muted">Semua Status</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless table-sm m-0">
                    <tr>
                        <td width="40%"><strong>Periode Akademik</strong></td>
                        <td width="5%">:</td>
                        {{-- Jika ada filter periode tampilkan periodenya, jika kosong tulis 'Semua Periode' --}}
                        <td><span class="font-weight-bold">{{ $periode ?? 'Semua Periode' }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Aktivitas</strong></td>
                        <td>:</td>
                        <td>
                            @if($jenis == 'AK' || $jenis == 'Aktivitas Kemahasiswaan')
                            Aktivitas Kemahasiswaan (AK)
                            @elseif($jenis == 'K' || $jenis == 'Kompetisi')
                            Kompetisi (K)
                            @elseif($jenis == 'PKM' || $jenis == 'Program Kreativitas Mahasiswa')
                            Program Kreativitas Mahasiswa (PKM)
                            @else
                            Semua Jenis Kegiatan
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-laporan text-center">
                <thead class="bg-light">
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Aktivitas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Nama Aktivitas</th>
                        <th>Tingkat Prestasi</th>
                        <th>Status Valid</th>
                        <th>SKPI</th>
                        <th>Poin</th>
                        <th>Validator</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->mahasiswa->nim }}</td>
                        <td class="text-left">{{ $row->mahasiswa->nama_lengkap }}</td>
                        <td>{{ $prodi }}</td>
                        <td>
                            @if($row->jenis_aktivitas == 'AK' || $row->jenis_aktivitas == 'Aktivitas Kemahasiswaan')
                            Aktivitas Kemahasiswaan
                            @elseif($row->jenis_aktivitas == 'K' || $row->jenis_aktivitas == 'Kompetisi')
                            Kompetisi
                            @elseif($row->jenis_aktivitas == 'PKM' || $row->jenis_aktivitas == 'Program Kreativitas Mahasiswa')
                            Program Kreativitas Mahasiswa
                            @else
                            {{ $row->jenis_aktivitas }}
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_mulai)->translatedFormat('d M Y') }}</td>
                        <td>{{ $row->tanggal_selesai ? \Carbon\Carbon::parse($row->tanggal_selesai)->translatedFormat('d M Y') : '-' }}</td>
                        <td class="text-left">{{ $row->nama_aktivitas }}</td>
                        <td>{{ $row->tingkat_prestasi }}</td>
                        <td>
                            {{-- Status dinamis di dalam baris tabel --}}
                            @if($row->status_validasi == 'valid')
                            <span class="text-success">Valid</span>
                            @elseif($row->status_validasi == 'menunggu')
                            <span class="text-warning">Menunggu</span>
                            @else
                            <span class="text-danger">Tidak Valid</span>
                            @endif
                        </td>
                        <td>{{ $row->skpi ?? 'Ya' }}</td>
                        <td><strong>{{ number_format($row->poin, 2) }}</strong></td>
                        <td>Admin</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted font-italic">Data tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>