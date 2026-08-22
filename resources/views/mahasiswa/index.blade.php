@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col p-2 p-md-4">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 d-flex justify-content-center justify-content-md-start mt-2 mt-md-0">
                        @can('create-mahasiswa')
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm btn-radius">
                            <i class="fas fa-plus"></i> Tambah Mahasiswa
                        </a>
                        @endcan
                    </div>
                    <div class="col-md-6 text-center">
                        <h4 class="m-0"><strong>DAFTAR MAHASISWA</strong></h4>
                    </div>
                    <div class="col-md-3 d-none d-md-block"></div>
                </div>
            </div>

            <div class="card-body p-2 p-md-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-nowrap w-100 align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Status</th>
                                <th>Tahun Lulus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $item)
                            <tr class="text-center">
                                <th>{{ $loop->iteration }}</th>
                                <td class="text-start">{{ $item->user->name }}</td>
                                <td>{{ $item->nim }}</td>
                                <td class="">
                                    @if($item->status === 'lulus')
                                    <span class="badge bg-yellow-1 px-3 btn-radius text-dark">Lulus (Alumni)</span>
                                    @else
                                    <span class="badge bg-primary px-3 btn-radius text-dark">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->tahun_lulus ?? '-' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @can('edit-mahasiswa')
                                        <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn bg-yellow-1 btn-radius-2 btn-sm mx-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan

                                        @can('delete-mahasiswa')
                                        <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="d-inline m-0 delete-form">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" class="btn btn-danger btn-sm btn-radius-2 btn-delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Data mahasiswa kosong atau tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-3 mx-3">
                {{ $mahasiswa->links() }}
            </div>

        </div>
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
                text: "Data mahasiswa ini beserta akun loginnya akan dihapus permanen!",
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