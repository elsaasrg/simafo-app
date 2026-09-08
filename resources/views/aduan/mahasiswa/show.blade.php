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
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-center m-0">
                Detail Aduan
            </h4>
        </div>

        <div class="card-body">

            <!-- Detail Aduan Table -->
            <table class="table table-bordered table-striped mb-5">
                <tbody>
                    <tr>
                        <th style="width: 20%;">Pelapor</th>
                        <td>

                            <span class="mr-2">
                                {{ auth()->user()->name }}
                            </span>


                        </td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">NIM</th>
                        <td>
                            {{ $aduan->mahasiswa->nim ?? '-' }}
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
                            <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-sm btn-primary btn-radius">
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
                            <span class="badge bg-yellow-1 btn-radius px-2 ">Menunggu Verifikasi</span>
                            @elseif($aduan->status == 'diproses')
                            <span class="badge bg-yellow-2 btn-radius px-2">Sedang Diproses</span>
                            @elseif($aduan->status == 'selesai')
                            <span class="badge bg-yellow-3 btn-radius px-2">Selesai</span>
                            @elseif($aduan->status == 'ditolak')
                            <span class="badge badge-danger btn-radius px-2">Ditolak</span>
                            @else
                            <span class="badge badge-secondary btn-radius px-2">{{ ucfirst($aduan->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Waktu Pengiriman</th>
                        <td>{{ $aduan->created_at ? $aduan->created_at->format('d F Y - H:i') : '-' }} WIB</td>
                    </tr>
                </tbody>
            </table>

            <!-- Tanggapan / Balasan Admin -->
            <h5 class="font-weight-bold mb-3">
                <i class="fas fa-reply mr-1"></i> Tanggapan / Solusi dari Jurusan
            </h5>

            @if($aduan->tanggapan !== '-')
            <div class="card bg-light border-success mb-3">
                <div class="card-header bg-success text-white font-weight-bold">
                    <i class="fas fa-user-shield mr-1"></i> Jawaban Jurusan
                </div>
                <div class="card-body" style="white-space: pre-line;">
                    {{ $aduan->tanggapan }}
                </div>
            </div>
            @else
            <div class="text-center py-4 border" role="alert">

                Belum ada tanggapan dari jurusan.
            </div>
            @endif

        </div>
    </div>
</div>

@endsection