@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col p-2 p-md-4">

        {{-- Alert Sukses ditaruh di luar tabel --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 d-flex justify-content-center justify-content-md-start mt-2 mt-md-0">
                        @can('create-dosen')
                        <a href="{{ route('dosen.create') }}" class="btn btn-success btn-sm btn-radius">
                            <i class="fas fa-plus-circle"></i> Tambah Dosen
                        </a>
                        @endcan
                    </div>
                    <div class="col-md-6 text-center">
                        <h4 class="m-0"><strong>DAFTAR DOSEN</strong></h4>
                    </div>
                    <div class="col-md-3 d-none d-md-block"></div>
                </div>
            </div>

            <div class="card-body p-2 p-md-3">
                <!-- WRAPPER UNTUK SCROLLING HORIZONTAL DI HP -->
                <div class="table-responsive">

                    <!-- Hapus table-layout: fixed dan tambahkan class text-nowrap -->
                    <table class="table table-bordered table-striped text-nowrap w-100 align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen as $item)
                            <tr class="text-center">
                                <th>{{ $loop->iteration }}</th>
                                <td class="text-start">{{ $item->user->name }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>
                                    @forelse($item->user->roles as $role)
                                    @if($role->name == 'Dosen')
                                    <span class="badge bg-yellow-1 p-1 btn-radius">Dosen</span>
                                    @elseif($role->name == 'DosenKemahasiswaan')
                                    <span class="badge bg-yellow-1 p-1 btn-radius">Dosen Kemahasiswaan</span>
                                    @elseif($role->name == 'Kajur')
                                    <span class="badge bg-yellow-1 p-1 btn-radius">Ketua Jurusan</span>
                                    @endif
                                    @empty
                                    <span class="badge bg-yellow-1 p-1 btn-radius">-</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @can('edit-dosen')
                                        <a href="{{ route('dosen.edit', $item->id) }}" class="btn btn-warning btn-sm mx-1 bg-kuning-1 btn-radius" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan

                                        @can('delete-dosen')
                                        <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm btn-radius" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data dosen</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div> <!-- PENUTUP TABLE-RESPONSIVE -->
            </div>

            <div class="mb-3 mx-3">
                {{ $dosen->links() }}
            </div>

        </div>
    </div>
</div>

@endsection