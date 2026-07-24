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

        {{-- 1. TAMPILAN UNTUK DOSEN / ADMIN (TABEL DATA) --}}
        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('DosenKemahasiswaan'))
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <span class="font-weight-bold"><i class="fas fa-trophy mr-1"></i> Kelola Informasi Lomba</span>
                <a href="{{ route('info-lomba.create') }}" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-plus-circle"></i> Tambah Informasi Lomba
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr class="text-center align-middle">
                                <th style="width: 50px">No</th>
                                <th>Nama Lomba</th>
                                <th>Deskripsi</th>
                                <th>Penyelenggara</th>
                                <th>Masa Pendaftaran</th>
                                <th>Link Pendaftaran</th>
                                <th>Contact Person</th>
                                <th>Diposting Oleh</th>
                                <th style="width: 130px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $infolomba as $item )
                            <tr class="align-middle">
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lomba }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>{{ $item->penyelenggara }}</td>
                                <td class="text-center small">{{ $item->tanggal_mulai_pendaftaran }} <br> s/d <br> {{ $item->tanggal_selesai_pendaftaran }}</td>
                                <td class="text-center">
                                    @if($item->link_pendaftaran)
                                    <a href="{{ $item->link_pendaftaran }}" target="_blank" class="btn btn-link btn-sm p-0">Buka Link</a>
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->contact_person ?? '-' }}</td>
                                <td class="text-center">{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm bg-kuning-3 btn-radius"
                                            data-toggle="modal" data-target="#detailModalAdmin{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <a href="{{ route('info-lomba.edit', $item->id) }}" class="btn btn-sm mx-1 bg-kuning-1 btn-radius"><i class="fas fa-edit"></i></a>

                                        <form action="{{ route('info-lomba.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger btn-sm btn-radius"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- MODAL DETAIL UNTUK ADMIN/DOSEN --}}
                            <div class="modal fade" id="detailModalAdmin{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-kuning-2">
                                            <h5 class="modal-title font-weight-bold text-dark">Detail Lomba: {{ $item->nama_lomba }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p><strong>Penyelenggara:</strong> {{ $item->penyelenggara }}</p>
                                            <p><strong>Diposting Oleh:</strong> {{ $item->user->name ?? 'Tidak Diketahui' }}</p>
                                            <p><strong>Masa Pendaftaran:</strong> {{ $item->tanggal_mulai_pendaftaran }} s/d {{ $item->tanggal_selesai_pendaftaran }}</p>

                                            @if($item->tanggal_mulai_pelaksanaan)
                                            <p><strong>Waktu Pelaksanaan:</strong> {{ $item->tanggal_mulai_pelaksanaan }} {{ $item->tanggal_selesai_pelaksanaan ? 's/d '.$item->tanggal_selesai_pelaksanaan : '' }}</p>
                                            @endif

                                            @if($item->tempat_pelaksanaan)
                                            <p><strong>Tempat Pelaksanaan:</strong> {{ $item->tempat_pelaksanaan }}</p>
                                            @endif

                                            @if($item->hadiah)
                                            <p><strong>Hadiah / Total Prize:</strong> {{ $item->hadiah }}</p>
                                            @endif

                                            <p><strong>Contact Person:</strong> {{ $item->contact_person ?? '-' }}</p>
                                            <hr>

                                            <p><strong>Deskripsi Lomba:</strong><br>{!! nl2br(e($item->deskripsi)) !!}</p>

                                            @if($item->syarat_ketentuan)
                                            <p><strong>Syarat & Ketentuan:</strong><br>{!! nl2br(e($item->syarat_ketentuan)) !!}</p>
                                            @endif

                                            @if($item->link_pendaftaran)
                                            <p><strong>Link Pendaftaran:</strong> <a href="{{ $item->link_pendaftaran }}" target="_blank">{{ $item->link_pendaftaran }}</a></p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Tidak ada data informasi lomba yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- 2. TAMPILAN UNTUK MAHASISWA (CARD GRID) --}}
        @elseif(Auth::user()->hasRole('Mahasiswa'))
        <h4 class="mb-4 font-weight-bold text-dark text-center"><i class="fas fa-bullhorn text-warning"></i> INFORMASI LOMBA</h4>

        <div class="row">
            @forelse($infolomba as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge badge-purple bg-light border text-primary px-2 py-1">
                                <i class="fas fa-university mr-1"></i> {{ $item->penyelenggara }}
                            </span>
                        </div>

                        <h5 class="card-title font-weight-bold text-dark mb-2">{{ $item->nama_lomba }}</h5>

                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->deskripsi, 120) }}</p>

                        <div class="mb-3 small">
                            <span class="text-danger font-weight-bold d-block mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i> Batas Pendaftaran:
                            </span>
                            <span class="text-muted pl-3">{{ $item->tanggal_selesai_pendaftaran }}</span>



                            @if($item->contact_person)
                            <span class="text-dark d-block mt-2">
                                <i class="fas fa-phone-alt mr-1"></i> Contact Person: {{ $item->contact_person }}
                            </span>
                            @endif
                        </div>

                        <div class="text-muted small text-right italic mb-2" style="font-size: 11px;">
                            Diposting Oleh: <strong>{{ $item->user->name ?? 'Tidak Diketahui' }}</strong>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex gap-2">
                            <button type="button" class="btn border-kuning btn-sm flex-fill mr-1"
                                data-toggle="modal" data-target="#detailModalMhs{{ $item->id }}">
                                <i class="fas fa-eye mr-1"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL DETAIL UNTUK MAHASISWA --}}
            <div class="modal fade" id="detailModalMhs{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-kuning-2">
                            <h5 class="modal-title font-weight-bold text-dark">Detail Lomba: {{ $item->nama_lomba }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <p><strong>Penyelenggara:</strong> {{ $item->penyelenggara }}</p>
                            <p><strong>Masa Pendaftaran:</strong> {{ $item->tanggal_mulai_pendaftaran }} s/d {{ $item->tanggal_selesai_pendaftaran }}</p>

                            @if($item->tanggal_mulai_pelaksanaan)
                            <p><strong>Waktu Pelaksanaan Lomba:</strong> {{ $item->tanggal_mulai_pelaksanaan }} {{ $item->tanggal_selesai_pelaksanaan ? 's/d '.$item->tanggal_selesai_pelaksanaan : '' }}</p>
                            @endif

                            @if($item->tempat_pelaksanaan)
                            <p><strong>Tempat Pelaksanaan:</strong> {{ $item->tempat_pelaksanaan }}</p>
                            @endif

                            @if($item->hadiah)
                            <p><strong>Hadiah / Total Prize:</strong> {{ $item->hadiah }}</p>
                            @endif

                            <p><strong>Contact Person:</strong> {{ $item->contact_person ?? '-' }}</p>
                            <p><strong>Diposting Oleh:</strong> {{ $item->user->name ?? 'Tidak Diketahui' }}</p>
                            <hr>

                            <p><strong>Deskripsi Lomba:</strong><br>{!! nl2br(e($item->deskripsi)) !!}</p>

                            @if($item->syarat_ketentuan)
                            <p class="mt-3"><strong>Syarat & Ketentuan:</strong><br>{!! nl2br(e($item->syarat_ketentuan)) !!}</p>
                            @endif

                            @if($item->link_pendaftaran)
                            <p><strong>Link Pendaftaran:</strong> {{ $item->link_pendaftaran }}</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="col-12 text-center text-muted py-5 card shadow-sm">
                <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i>
                <p class="m-0">Belum ada informasi perlombaan terbaru untuk saat ini.</p>
            </div>
            @endforelse
        </div>
        @endif

    </div>
</div>
@endsection