@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="row w-100">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 text-center">
                    <h4 class="m-0"><strong>DATA KONSELING</strong></h4>

                </div>
                <div class="col-md-3 d-flex justify-content-center justify-content-md-end">
                    <a href="{{ route('konseling.create') }}"
                        class="btn btn-sm btn-success btn-sm btn-radius">
                        <i class="fas fa-plus"></i>Tambah Konseling
                    </a>

                </div>
            </div>

        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Subjek</th>
                            <th>Nama Dosen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($konseling as $item)

                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->subjek }}
                            </td>

                            <td>
                                {{ $item->dosen->user->name }}
                            </td>

                            <td class="text-center">
                                <div class="badge bg-green-2 btn-radius px-2">{{ $item->status }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- Tombol Detail selalu muncul di semua status --}}
                                    <a href="{{ route('konseling.show', $item->id) }}"
                                        class="btn bg-yellow-1 btn-sm mx-1 btn-radius"
                                        style="padding: .25rem .4rem;"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- Tombol Edit & Hapus HANYA muncul jika statusnya 'dikirim' --}}
                                    @if($item->status == 'dikirim')
                                    <a href="{{ route('konseling.edit', $item->id) }}"
                                        class="btn bg-yellow-1 btn-sm mx-1 btn-radius"
                                        style="padding: .25rem .4rem;"
                                        title="Edit Pengajuan">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('konseling.destroy', $item->id) }}" method="POST" class="d-inline m-0 delete-form">
                                        @csrf
                                        @method("DELETE")
                                        <button type="button"
                                            class="btn btn-danger btn-sm btn-radius btn-delete"
                                            style="padding: .25rem .4rem;"
                                            title="Hapus Pengajuan">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif


                                </div>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data konseling
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $konseling->links() }}

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
                text: "Data konseling ini akan dihapus permanen!",
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