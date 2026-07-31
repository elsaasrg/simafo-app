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
            <div class="text-center row align-items-center pt-3">
                <div class="col-md-3"></div>
                <h4 class="font-weight-bold col-md-6 mb-0"><i class="fas fa-trophy"></i> KELOLA INFORMASI LOMBA</h4>
                <div class="col-md-3">
                    <a href="{{ route('info-lomba.create') }}" class="btn btn-success btn-sm btn-radius">
                        <i class="fas fa-plus-circle"></i> Tambah Info Lomba
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="width:100%">
                        <thead>
                            <tr class="text-center align-middle">
                                <th style="width: 50px">No</th>
                                <th>Nama Lomba</th>
                                <th>Deskripsi</th>
                                <th>Penyelenggara</th>
                                <th>Tanggal Pendaftaran</th>

                                <th>Contact Person</th>
                                <th>Diposting Oleh</th>
                                <th>Aksi</th>
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

                                <td class="text-center">{{ $item->contact_person ?? '-' }}</td>
                                <td class="text-center">{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                <td class="text-center">
                                    <div class="text-nowrap">
                                        <button type="button" class="btn btn-sm bg-yellow-3 btn-radius"
                                            data-toggle="modal" data-target="#detailModalAdmin{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <a href="{{ route('info-lomba.edit', $item->id) }}" class="btn btn-sm bg-yellow-1 btn-radius"><i class="fas fa-edit"></i></a>

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
                                        <div class="modal-header bg-yellow-2">
                                            <h5 class="modal-title font-weight-bold text-dark">Detail Lomba: {{ $item->nama_lomba }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p><strong>Penyelenggara:</strong> {{ $item->penyelenggara }}</p>
                                            <p><strong>Diposting Oleh:</strong> {{ $item->user->name ?? 'Tidak Diketahui' }}</p>
                                            <p><strong>Tanggal Pendaftaran:</strong> {{ $item->tanggal_mulai_pendaftaran }} s/d {{ $item->tanggal_selesai_pendaftaran }}</p>

                                            @if($item->tanggal_mulai_pelaksanaan)
                                            <p><strong>Tanggal Pelaksanaan:</strong> {{ $item->tanggal_mulai_pelaksanaan }} {{ $item->tanggal_selesai_pelaksanaan ? 's/d '.$item->tanggal_selesai_pelaksanaan : '' }}</p>
                                            @endif

                                            @if($item->tempat_pelaksanaan)
                                            <p><strong>Tempat Pelaksanaan:</strong> {{ $item->tempat_pelaksanaan }}</p>
                                            @endif

                                            @if($item->hadiah)
                                            <p><strong>Hadiah / Total Prize:</strong> {{ $item->hadiah }}</p>
                                            @endif

                                            <p><strong>Contact Person:</strong> {{ $item->contact_person ?? '-' }}</p>

                                            <p><strong>Deskripsi Lomba:</strong><br>{!! nl2br(e($item->deskripsi)) !!}</p>

                                            @if($item->syarat_ketentuan)
                                            <p><strong>Syarat & Ketentuan:</strong><br>{!! nl2br(e($item->syarat_ketentuan)) !!}</p>
                                            @endif

                                            @if($item->link_pendaftaran)
                                            <p><strong>Link Pendaftaran:</strong> <a href="{{ $item->link_pendaftaran }}" target="_blank">{{ $item->link_pendaftaran }}</a></p>
                                            @endif
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
                            <span class="badge bg-light border text-primary px-2 py-1 d-block text-wrap">
                                <p> <i class="fas fa-university mr-1"></i> {{ $item->penyelenggara }}
                                <p>
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
                            Diposting Oleh: {{ $item->user->name ?? 'Tidak Diketahui' }}
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex gap-2">
                            <button type="button" class="btn border-yellow btn-radius btn-sm flex-fill mr-1"
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
                        <div class="modal-header bg-yellow-2">
                            <div class="row w-100">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 text-center">
                                    <h5 class="font-weight-bold text-dark">Detail Lomba: {{ $item->nama_lomba }}</h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body text-left">
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Penyelenggara:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->penyelenggara }}
                                </div>
                            </div>
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Tanggal Pendaftaran:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->tanggal_mulai_pendaftaran }} s/d {{ $item->tanggal_selesai_pendaftaran }}
                                </div>
                            </div>
                            @if($item->tanggal_mulai_pelaksanaan)
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Tanggal Pelaksanaan:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->tanggal_mulai_pelaksanaan }} {{ $item->tanggal_selesai_pelaksanaan ? 's/d '.$item->tanggal_selesai_pelaksanaan : '' }}
                                </div>
                            </div>
                            @endif

                            @if($item->tempat_pelaksanaan)
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Tempat Pelaksanaan:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->tempat_pelaksanaan }}
                                </div>
                            </div>
                            @endif

                            @if($item->hadiah)
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Hadiah / Total Prize:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->hadiah }}
                                </div>
                            </div>

                            @endif
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Contact Person:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->contact_person ?? '-' }}
                                </div>
                            </div>
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Diposting Oleh:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->user->name ?? 'Tidak Diketahui' }}
                                </div>
                            </div>

                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Deskripsi Lomba:</strong>
                                </div>
                                <div class="col-md-9">
                                    {!! nl2br(e($item->deskripsi)) !!}
                                </div>
                            </div>


                            @if($item->syarat_ketentuan)
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Syarat & Ketentuan:</strong>
                                </div>
                                <div class="col-md-9">
                                    {!! nl2br(e($item->syarat_ketentuan)) !!}
                                </div>
                            </div>
                            @endif

                            @if($item->link_pendaftaran)
                            <div class="row w-100 mb-3">
                                <div class="col-md-3">
                                    <strong>Link Pendaftaran:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $item->link_pendaftaran }}
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            @empty
            <div class="col-12 text-ce{{ $item->link_pendaftaran }}nter text-muted py-5 card shadow-sm">
                <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i>
                <p class="m-0">Belum ada informasi perlombaan terbaru untuk saat ini.</p>
            </div>
            @endforelse
        </div>
        @endif

    </div>
</div>
@endsection