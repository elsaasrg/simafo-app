@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col">

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
            <div class="row align-items-center text-center py-3">
                <div class="col-md-3"></div>
                <h4 class="font-weight-bold col-md-6 mb-0 "></i> KELOLA INFORMASI BEASISWA</h4>
                <div class="col-md-3">
                    <a href="{{ route('info-beasiswa.create') }}" class="btn btn-success btn-sm btn-radius">
                        <i class="fas fa-plus-circle "></i> Tambah Info Beasiswa
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table " style="width:100%">
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
                                    <div aria-label="Aksi Data">
                                        <button type="button" class="btn btn-sm bg-yellow-1 btn-radius"
                                            data-toggle="modal" data-target="#detailModal{{ $item->id }}"
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye text-dark"></i>
                                        </button>

                                        @if(auth()->user()->hasRole('DosenKemahasiswaan') || auth()->user()->hasRole('Admin'))
                                        <a href="{{ route('info-beasiswa.edit', $item->id) }}" class="btn btn-sm btn-radius bg-yellow-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('info-beasiswa.destroy', $item->id) }}" method="POST" class="d-inline-block m-0 p-0" onsubmit="return confirm('Yakin ingin menghapus informasi beasiswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-radius">
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
                                        <div class="modal-header bg-yellow-2">
                                            <div class="row d-flex justify-content-center align-items-center w-100">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8 text-center">
                                                    <h5 class="modal-title font-weight-bold text-dark">Detail Beasiswa: {{ $item->nama_beasiswa }}</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body text-start" style="text-align: left !important;">

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Penyelenggara</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {{ $item->penyelenggara }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Contact Person:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {{ $item->contact_person ?? '-' }}
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Tanggal Pendaftaran</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->format('d M Y') }}
                                                    s/d
                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Deskripsi</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {!! nl2br(e($item->deskripsi)) !!}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Syarat & Kriteria</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {!! nl2br(e($item->syarat)) !!}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Benefit / Cakupan</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {!! nl2br(e($item->benefit)) !!}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Link Pendaftaran</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : @if($item->link_pendaftaran)
                                                    <a href="{{ $item->link_pendaftaran }}" target="_blank" class="text-primary">{{ $item->link_pendaftaran }}</a>
                                                    @else
                                                    -
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <strong>Diposting Oleh</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    : {{ $item->user->name ?? 'Tidak Diketahui' }}
                                                </div>
                                            </div>
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
        <h3 class="mb-4 font-weight-bold text-dark text-center"><i class="fas fa-bullhorn text-warning mr-2"></i> Informasi Beasiswa</h3>

        <div class="row">
            @forelse($infoBeasiswa as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-light border text-primary px-2 py-1 d-block text-wrap"><i class="fas fa-university mr-1"></i> {{ $item->penyelenggara }}</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-2">{{ $item->nama_beasiswa }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->deskripsi, 120) }}</p>
                        <hr class="my-2">
                        <div class="mb-3 small">
                            <div class="text-danger mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i> <strong> Batas Pendaftaran: </strong>
                                <span class="text-dark">{{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}</span>
                            </div>

                            @if($item->contact_person)
                            <span class="text-dark mt-2">
                                <i class="fas fa-phone-alt mr-1"></i> <strong>Contact Person: </strong> {{ $item->contact_person }}
                            </span>
                            @endif

                            <span class="text-muted d-block mt-2 small text-right">
                                Diposting Oleh: {{ $item->user->name ?? 'Tidak Diketahui' }}
                            </span>
                        </div>

                        <div class="d-flex gap-2 mt-auto">
                            <button type="button" class="btn border-yellow btn-sm flex-fill mr-1"
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
                        <div class="modal-header bg-yellow-2">
                            <div class="row w-100">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 text-center">
                                    <h5 class="font-weight-bold text-dark">Detail Beasiswa: {{ $item->nama_beasiswa }}</h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body text-start" style="text-align: left !important;">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Penyelenggara:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->penyelenggara }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Diposting Oleh:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->user->name ?? 'Tidak Diketahui' }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Contact Person:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->contact_person ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Periode Pendaftaran:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->format('d M Y') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Deskripsi:</strong>
                                </div>
                                <div class="col-md-9">
                                    {!! nl2br(e($item->deskripsi)) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Syarat & Kriteria:</strong>
                                </div>
                                <div class="col-md-9">
                                    {!! nl2br(e($item->syarat)) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Benefit </strong>
                                </div>
                                <div class="col-md-9">
                                    {!! nl2br(e($item->benefit)) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Link Pendaftaran:</strong>
                                </div>
                                <div class="col-md-9">
                                    @if($item->link_pendaftaran)
                                    <a href="{{ $item->link_pendaftaran }}" target="_blank" class="text-primary">{{ $item->link_pendaftaran }}</a>
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>

                            </p>
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