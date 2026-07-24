@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">

        {{-- Flash Message Berhasil --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- 1. TAMPILAN UNTUK DOSEN / ADMIN (BENTUK TABEL MANAGEMENT DATA) --}}
        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('DosenKemahasiswaan'))
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="font-weight-bold"><i class="fas fa-graduation-cap mr-1"></i> Kelola Informasi Beasiswa</span>
                <a href="{{ route('info-beasiswa.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle"></i> Tambah Info Beasiswa
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr class="text-center align-middle">
                                <th style="width: 50px">No</th>
                                <th>Nama Beasiswa</th>
                                <th>Penyelenggara</th>
                                <th>Periode Pendaftaran</th>
                                <th>Contact Person</th>
                                <th>Diposting Oleh</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infoBeasiswa as $key => $item)
                            <tr class="align-middle">
                                <td class="text-center font-weight-bold">{{ $infoBeasiswa->firstItem() + $key }}</td>
                                <td>{{ $item->nama_beasiswa }}</td>
                                <td>{{ $item->penyelenggara }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->format('d M Y') }}
                                    <br>s/d<br>
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}
                                </td>
                                <td class="text-center">{{ $item->contact_person ?? '-' }}</td>
                                <td class="text-center">{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi Data">
                                        <button type="button" class="btn btn-info btn-sm text-white"
                                            data-toggle="modal" data-target="#detailModal{{ $item->id }}"
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        @if(auth()->user()->hasRole('DosenKemahasiswaan') || auth()->user()->hasRole('Admin'))
                                        <a href="{{ route('info-beasiswa.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('info-beasiswa.destroy', $item->id) }}" method="POST" class="d-inline-block m-0 p-0" onsubmit="return confirm('Yakin ingin menghapus informasi beasiswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-top-left-radius: 0; border-bottom-left-radius: 0; height: 100%;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            {{-- MODAL DETAIL UNTUK ADMIN/DOSEN --}}
                            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title font-weight-bold text-dark">Detail Beasiswa: {{ $item->nama_beasiswa }}</h5>
                                            <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-start" style="text-align: left !important;">
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Penyelenggara:</strong> {{ $item->penyelenggara }}</p>
                                                    <p class="mb-1"><strong>Contact Person:</strong> {{ $item->contact_person ?? '-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Diposting Oleh:</strong> {{ $item->user->name ?? 'Tidak Diketahui' }}</p>
                                                    <p class="mb-1"><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }} WIB</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <p class="mb-2"><strong>Periode Pendaftaran:</strong><br>
                                                {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->format('d M Y') }}
                                                s/d
                                                {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}
                                            </p>
                                            <p class="mb-2"><strong>Deskripsi:</strong><br>{!! nl2br(e($item->deskripsi)) !!}</p>
                                            <p class="mb-2"><strong>Syarat & Kriteria:</strong><br>{!! nl2br(e($item->syarat)) !!}</p>
                                            <p class="mb-2"><strong>Benefit / Cakupan:</strong><br>{!! nl2br(e($item->benefit)) !!}</p>
                                            <p class="mb-0"><strong>Link Pendaftaran:</strong>
                                                @if($item->link_pendaftaran)
                                                <a href="{{ $item->link_pendaftaran }}" target="_blank" class="text-primary">{{ $item->link_pendaftaran }}</a>
                                                @else
                                                -
                                                @endif
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm bg-abu-abu btn-radius" data-dismiss="modal" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada informasi beasiswa yang diposting.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $infoBeasiswa->links() }}
                </div>
            </div>
        </div>

        {{-- 2. TAMPILAN UNTUK MAHASISWA (BENTUK CARD GRID PENGUMUMAN) --}}
        @elseif(Auth::user()->hasRole('Mahasiswa'))
        <h3 class="mb-4 font-weight-bold text-dark"><i class="fas fa-bullhorn text-warning mr-2"></i> Informasi Beasiswa</h3>

        <div class="row">
            @forelse($infoBeasiswa as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <span class="badge badge-purple bg-light border text-primary px-2 py-1"><i class="fas fa-university mr-1"></i> {{ $item->penyelenggara }}</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-2">{{ $item->nama_beasiswa }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->deskripsi, 120) }}</p>
                        <hr class="my-2">
                        <div class="mb-3 small">
                            <span class="text-danger font-weight-bold d-block mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i> Batas Pendaftaran:
                            </span>
                            <span class="text-muted pl-3">{{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}</span>

                            @if($item->contact_person)
                            <span class="text-dark d-block mt-2">
                                <i class="fas fa-phone-alt mr-1"></i> CP: {{ $item->contact_person }}
                            </span>
                            @endif

                            <span class="text-muted d-block mt-2 small text-right font-italic">
                                Diposting Oleh: {{ $item->user->name ?? 'Tidak Diketahui' }}
                            </span>
                        </div>

                        <div class="d-flex gap-2 mt-auto">
                            <button type="button" class="btn btn-outline-info btn-sm flex-fill mr-1 text-info"
                                data-toggle="modal" data-target="#detailModal{{ $item->id }}"
                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                <i class="fas fa-eye mr-1"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL DETAIL UNTUK MAHASISWA --}}
            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-kuning-2">
                            <h5 class="modal-title font-weight-bold text-dark">Detail Beasiswa: {{ $item->nama_beasiswa }}</h5>
                            <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-start" style="text-align: left !important;">
                            <p class="mb-1"><strong>Penyelenggara:</strong> {{ $item->penyelenggara }}</p>
                            <p class="mb-1"><strong>Diposting Oleh:</strong> {{ $item->user->name ?? 'Tidak Diketahui' }}</p>
                            <p class="mb-2"><strong>Contact Person:</strong> {{ $item->contact_person ?? '-' }}</p>
                            <hr>
                            <p class="mb-2"><strong>Periode Pendaftaran:</strong><br>
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->format('d M Y') }}
                                s/d
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}
                            </p>
                            <p class="mb-2"><strong>Deskripsi:</strong><br>{!! nl2br(e($item->deskripsi)) !!}</p>
                            <p class="mb-2"><strong>Syarat & Kriteria:</strong><br>{!! nl2br(e($item->syarat)) !!}</p>
                            <p class="mb-2"><strong>Benefit </strong><br>{!! nl2br(e($item->benefit)) !!}</p>
                            <p class="mb-0"><strong>Link Pendaftaran:</strong>
                                @if($item->link_pendaftaran)
                                <a href="{{ $item->link_pendaftaran }}" target="_blank" class="text-primary">{{ $item->link_pendaftaran }}</a>
                                @else
                                -
                                @endif
                            </p>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5 card shadow-sm">
                <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i>
                <p class="m-0">Belum ada informasi beasiswa terbaru untuk saat ini.</p>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $infoBeasiswa->links() }}
        </div>
        @endif

    </div>
</div>
@endsection