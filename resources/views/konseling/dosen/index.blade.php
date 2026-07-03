@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                Daftar Konseling Masuk
            </div>
            <div class="card-body">
                <table class="table table-fixed" style="table-layout:fixed">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width: 50px">No</th>
                            <th>Subjek</th>
                            <th style="">Isi</th>
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
                                <div style="max-width: 500px;">
                                    {{ $item->isi_konseling }}
                                </div>
                            </td>
                            <td>{{ $item->mahasiswa->user->name }}</td>
                            <td>
                                <div class="badge bg-primary">{{ $item->status }}</div>
                            </td>
                            <td>
                                <a href="{{ route('konseling.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
@endsection