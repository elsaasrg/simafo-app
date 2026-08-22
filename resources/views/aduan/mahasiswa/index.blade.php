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

    <h4 class="font-weight-bold text-center mb-3">
        DAFTAR ADUAN
    </h4>
    <div class="card shadow-sm">
        <div class="card-header text-center py-3">
            <div class="row w-100">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3 d-flex justify-content-center justify-content-md-end">
                    <a href="{{ route('aduan.create') }}" class="btn btn-success btn-sm btn-radius">
                        <i class="fas fa-plus mr-1"></i> Tambah Aduan
                    </a>
                </div>
            </div>

        </div>


        <div class="card-body p-2">
            <div class="table-responsive ">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width: 60px">No</th>
                            <th>Subjek Pengaduan</th>
                            <th>Kategori</th>
                            <th style="width: 130px">Status</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($aduan as $item)
                        <tr class="align-middle">
                            {{-- Nomor Urut Terpaginasi --}}
                            <td class="text-center">
                                {{ $loop->iteration + ($aduan->currentPage() - 1) * $aduan->perPage() }}
                            </td>

                            {{-- Subjek & Meta Info --}}
                            <td>
                                <span class="d-block text-dark">{{ $item->subjek }}</span>
                            </td>

                            {{-- Kategori --}}
                            <td class="text-center">

                                {{ ucfirst(str_replace('_', ' ', $item->kategori ?? 'Lainnya')) }}

                            </td>

                            {{-- Badge Status --}}
                            <td class="text-center">
                                @if($item->status == 'menunggu')
                                <span class="badge bg-yellow-1 px-2 btn-radius">Menunggu</span>
                                @elseif($item->status == 'diproses')
                                <span class="badge badge-sm bg-yellow-2 px-2 btn-radius">Diproses</span>
                                @elseif($item->status == 'selesai')
                                <span class="badge bg-yellow-3 px-2 btn-radius">Selesai</span>
                                @elseif($item->status == 'ditolak')
                                <span class="badge badge-danger px-2 btn-radius">Ditolak</span>
                                @else
                                <span class="badge badge-secondary px-2 btn-radius">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div>
                                    {{-- Edit & Hapus HANYA jika status masih 'menunggu' --}}
                                    @if($item->status == 'menunggu')
                                    <a href="{{ route('aduan.edit', $item->id) }}"
                                        class="btn bg-yellow-1 btn-sm btn-radius"
                                        title="Edit Aduan">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('aduan.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method("DELETE")
                                        <button type="button"

                                            class="btn btn-danger btn-sm btn-radius btn-delete"
                                            title="Hapus Aduan">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif

                                    {{-- Detail Selalu Tampil --}}
                                    <a href="{{ route('aduan.show', $item->id) }}"
                                        class="btn bg-yellow-3 btn-sm btn-radius"
                                        title="Lihat Detail & Balasan">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>
                                Anda belum pernah membuat aduan.
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

@push('js')
<script>
    // Konfirmasi Hapus Data
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            let form = this.closest('.delete-form');

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data aduan ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush