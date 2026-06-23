<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
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
                <span class="font-weight-bold"><i class="fas fa-trophy mr-1"></i> Kelola Informasi Lomba</span>
                <a href="{{ route('info-lomba.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle"></i> Tambah Lomba
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
                                <th>Tanggal Pendaftaran</th>
                                <th>Link Pendaftaran</th>
                                <th>Contact Person</th>
                                <th style="width: 150px">Aksi</th>
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
                                <td class="text-center">
                                    <form action="{{ route('info-lomba.destroy', $item->id) }}" method="POST" class="btn-group" role="group">
                                        @csrf
                                        @method("DELETE")
                                        <a href="{{ route('info-lomba.edit', $item->id) }}" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Tidak ada data informasi lomba yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @elseif(Auth::user()->hasRole('Mahasiswa'))
        <h3 class="mb-4 font-weight-bold text-dark"><i class="fas fa-bullhorn text-warning mr-2"></i> Informasi Lomba</h3>

        <div class="row">
            @forelse($infolomba as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge badge-purple bg-light border text-primary px-2 py-1"><i class="fas fa-university mr-1"></i> {{ $item->penyelenggara }}</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-2">{{ $item->nama_lomba }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->deskripsi, 120) }}</p>
                        <hr class="my-2">
                        <div class="mb-3 small">
                            <span class="text-danger font-weight-bold d-block mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i> Batas Pendaftaran:
                            </span>
                            <span class="text-muted pl-3">{{ $item->tanggal_selesai_pendaftaran }}</span>

                            @if($item->contact_person)
                            <span class="text-dark d-block mt-2">
                                <i class="fas fa-phone-alt mr-1"></i> CP: {{ $item->contact_person }}
                            </span>
                            @endif
                        </div>

                        @if($item->link_pendaftaran)
                        <a href="{{ $item->link_pendaftaran }}" target="_blank" class="btn btn-primary btn-sm btn-block shadow-sm">
                            <i class="fas fa-external-link-alt mr-1"></i> Daftar Sekarang
                        </a>
                        @endif
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