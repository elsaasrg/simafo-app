@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">

        {{-- Tempatkan Alert Sukses di luar kartu agar lebih rapi --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="text-center font-weight-bold">
                    <h3>DAFTAR MAHASISWA </h3>
                </div>
                <div class="P-2">
                    @can('create-mahasiswa')
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm btn-radius">
                        <i class="fas fa-plus"></i> Tambah Mahasiswa
                    </a>
                    @endcan
                </div>

            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped" style="table-layout: fixed; width:100%">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width:5%;">No</th>
                            <th>Nama</th>
                            <th style="width:15%;">NIM</th>
                            <th style="width:15%;">Status</th> {{-- Kolom Baru --}}
                            <th style="width:15%;">Tahun Lulus</th> {{-- Kolom Baru --}}
                            <th style="width:15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $item)
                        <tr class="text-center align-middle">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-start">{{ $item->user->name }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>
                                {{-- Badge Status Dinamis --}}
                                @if($item->status === 'lulus')
                                <span class="badge bg-success">Lulus (Alumni)</span>
                                @else
                                <span class="badge bg-primary">Aktif</span>
                                @endif
                            </td>
                            <td>
                                {{-- Menampilkan tahun lulus jika ada, jika tidak tampilkan tanda strip --}}
                                {{ $item->tahun_lulus ?? '-' }}
                            </td>
                            <td>
                                <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="btn-group">
                                    @csrf
                                    @method("DELETE")

                                    @can('edit-mahasiswa')
                                    <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn bg-kuning-1 btn-radius-2 btn-sm mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('delete-mahasiswa')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini beserta akun loginnya?');" class="btn btn-danger btn-sm btn-radius-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data mahasiswa kosong atau tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mb-3 mx-4">
                {{ $mahasiswa->links() }}
            </div>

        </div>
    </div>
</div>

@endsection