@extends('layouts.app')

@section('content')

{{-- Flash Message Berhasil --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                Kelola Aduan
            </div>
            <div class="card-body">
                <table class="table table-fixed" style="table-layout:fixed">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width: 50px">No</th>
                            <th>Subjek Pengaduan</th>
                            <th>Nama Pengirim</th>
                            <th style="width:100px">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $aduan as $item )
                        <tr class="text-center align-middle">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->subjek }}</td>

                            <td>{{ $item->mahasiswa->user->name }}</td>
                            <td>
                                <div calass="badge bg-primary">{{ $item->status }}</div>
                            </td>
                            <td>
                                <a href="{{ route('aduan.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <form action="{{ route('aduan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="5">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection