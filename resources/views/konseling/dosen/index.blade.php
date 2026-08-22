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



        <div class="card">
            <div class="card-header text-center py-3">
                <h4 class="font-weight-bold">DAFTAR KONSELING MASUK</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-fixed">
                        <thead>
                            <tr class="text-center align-middle">
                                <th style="width: 50px">No</th>
                                <th>Subjek</th>
                                <th>Isi</th>
                                <th>Nama Mahasiswa</th>
                                <th style="width:100px">Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $konseling as $item )
                            <tr class="text-center align-middle">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->subjek }}</td>
                                <td>
                                    <span class="d-inline-block text-truncate align-middle" style="max-width: 450px;" title="{{ $item->isi_konseling }}">
                                        {{ Str::limit($item->isi_konseling, 60, '...') }}
                                    </span>
                                </td>
                                <td>{{ $item->mahasiswa->user->name }}</td>
                                <td>
                                    <div class="badge bg-primary btn-radius px-2">{{ $item->status }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('konseling.show',$item->id) }}" class="btn bg-yellow-3 btn-sm btn-radius"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="6">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection