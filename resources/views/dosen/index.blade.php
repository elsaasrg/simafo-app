@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h3>DAFTAR DOSEN</h3>
            </div>
            <div class="card-body">
                <table class="table" style="table-layout: fixed; width:100%">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width:5%;">No</th>
                            <th class="p-2">Nama</th>
                            <th class="p-1">NIP</th>
                            <th class="p-1">Role</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('create-dosen')
                        <a href="{{ route('dosen.create') }}" class="btn btn-success btn-sm mb-2 btn-radius"><i class="fas fa-plus-circle"></i> Tambah dosen</a>
                        @endcan

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @forelse($dosen as $item)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ $item->user->name }}</td>
                            <td class="align-middle">{{ $item->nip }}</td>
                            <td class="align-middle">
                                @forelse($item->user->roles as $role)
                                <span class="badge badge-info">
                                    {{ $role->name }}
                                </span>
                                @empty
                                <span class="badge badge-secondary">-</span>
                                @endforelse
                            </td>
                            <td>

                                <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" class="d-flex justify-content-center">
                                    @csrf
                                    @method("DELETE")
                                    @can('edit-dosen')
                                    <div class="btn-radius">
                                        <a href="{{ route('dosen.edit',$item->id) }}" class="btn btn-warning btn-sm mx-1 bg-kuning-1 btn-radius"><i class="fas fa-edit"></i></a>
                                    </div>
                                    @endcan

                                    @can('delete-dosen')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm btn-radius"><i class="fas fa-trash"></i></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>

                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 mx-5">
                {{ $dosen->links() }}
            </div>

        </div>
    </div>
</div>

@endsection