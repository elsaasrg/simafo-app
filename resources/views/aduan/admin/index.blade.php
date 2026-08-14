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

    {{-- Flash Message Error --}}
    @if(session('error') || $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') ?? $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header py-3">
            <h4 class="text-center font-weight-bold">
                Kelola Aduan
            </h4>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width: 60px">No</th>
                            <th>Subjek Pengaduan</th>
                            <th>Kategori</th>
                            <th>Nama Pengirim</th>
                            <th style="width: 120px">Status</th>
                            <th style="width: 130px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $aduan as $item )
                        <tr class="align-middle">
                            <td class="text-center">
                                {{ $loop->iteration + ($aduan->currentPage() - 1) * $aduan->perPage() }}
                            </td>
                            <td>
                                <span class=" d-block text-dark">{{ $item->subjek }}</span>
                                <!-- <small class="text-muted">
                                    <i class="far fa-clock mr-1"></i>{{ $item->created_at ? $item->created_at->diffForHumans() : '-' }}
                                </small> -->
                            </td>

                            {{-- Kategori --}}
                            <td class="text-center">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori ?? 'Lainnya')) }}
                            </td>


                            <td class="text-center">

                                <span class="d-block">
                                    {{ $item->mahasiswa->nama_lengkap ?? $item->mahasiswa->user->name }}
                                </span>
                                <small class="text-muted">({{ $item->mahasiswa->nim ?? '-' }})</small>

                            </td>

                            {{-- Badge Status --}}
                            <td class="text-center">
                                @if($item->status == 'menunggu')
                                <span class="badge bg-yellow-1">Menunggu</span>
                                @elseif($item->status == 'diproses')
                                <span class="badge badge-sm bg-yellow-2">Diproses</span>
                                @elseif($item->status == 'selesai')
                                <span class="badge bg-yellow-3">Selesai</span>
                                @elseif($item->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-secondary">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <a href="{{ route('aduan.show', $item->id) }}" class="btn bg-yellow-1 btn-sm mr-1 btn-radius" title="Detail Aduan">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('aduan.destroy', $item->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data aduan ini?');" class="btn btn-danger btn-sm btn-radius" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center py-4" colspan="6">
                                <i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>
                                Belum ada aduan masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Footer --}}
        @if($aduan->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $aduan->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif

    </div>
</div>

@endsection