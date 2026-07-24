@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">

    {{-- Flash Message Success --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="font-weight-bold " style="display: inline;">
                Detail Aduan
            </h4>
            <div class="card-tools">
                <a href="{{ route('aduan.index') }}" class="btn btn-sm bg-abu-abu btn-radius text-white">
                    Kembali
                </a>
            </div>
        </div>

        <div class="card-body">

            <!-- Detail Aduan Table -->
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th style="width: 20%;">Pelapor</th>
                        <td>
                            @if($aduan->is_anonim)
                            <span class="badge badge-dark p-2 mr-2 btn-radius">
                                <i class="fas fa-user-secret mr-1"></i> Anonim
                            </span>
                            @else
                            <span class="mr-2">
                                {{ $aduan->mahasiswa->nama_lengkap ?? auth()->user()->name }}
                            </span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">NIM</th>
                        <td>
                            @if($aduan->is_anonim)
                            <span>

                            </span>
                            @else

                            <span class="badge badge-light border">
                                NIM: {{ $aduan->mahasiswa->nim ?? '-' }}
                            </span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>

                            {{ ucfirst(str_replace('_', ' ', $aduan->kategori ?? 'Lainnya')) }}

                        </td>
                    </tr>
                    <tr>
                        <th>Subjek</th>
                        <td>{{ $aduan->subjek }}</td>
                    </tr>
                    <tr>
                        <th>Isi Aduan</th>
                        <td style="white-space: pre-line;">{{ $aduan->isi_aduan }}</td>
                    </tr>
                    <tr>
                        <th>Lampiran Bukti</th>
                        <td>
                            @if($aduan->lampiran)
                            <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-paperclip mr-1"></i> Lihat / Unduh Lampiran
                            </a>
                            @else
                            <span class="text-muted font-italic">Tidak ada lampiran terlampir</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status Pengaduan</th>
                        <td>
                            @if($aduan->status == 'menunggu')
                            <span class="badge bg-kuning-1 btn-radius">Menunggu Verifikasi</span>
                            @elseif($aduan->status == 'diproses')
                            <span class="badge bg-kuning-2 btn-radius">Sedang Diproses</span>
                            @elseif($aduan->status == 'selesai')
                            <span class="badge bg-kuning-3 btn-radius">Selesai</span>
                            @elseif($aduan->status == 'ditolak')
                            <span class="badge badge-danger btn-radius">Ditolak</span>
                            @else
                            <span class="badge badge-secondary btn-radius">{{ ucfirst($aduan->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengiriman</th>
                        <td>{{ $aduan->created_at ? $aduan->created_at->format('d F Y - H:i') : '-' }} WIB</td>
                    </tr>
                </tbody>
            </table>

            <hr class="my-4">

            <!-- Tanggapan / Balasan Admin -->
            <h5 class="font-weight-bold mb-3">
                <i class="fas fa-reply mr-1"></i> Tanggapan / Solusi dari Jurusan
            </h5>

            @if($aduan->tanggapan !== '-')
            <div class="card bg-light border-success mb-3">
                <div class="card-header bg-success text-white font-weight-bold">
                    <i class="fas fa-user-shield mr-1"></i> Jawaban Resmi Jurusan
                </div>
                <div class="card-body" style="white-space: pre-line;">
                    {{ $aduan->tanggapan }}
                </div>
            </div>
            @else
            <div class="alert alert-secondary text-center py-4" role="alert">
                <i class="fas fa-clock fa-2x mb-2 d-block text-secondary"></i>
                Belum ada tanggapan resmi dari jurusan.
            </div>
            @endif

        </div>
    </div>
</div>

@endsection