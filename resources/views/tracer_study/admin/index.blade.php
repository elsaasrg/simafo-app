@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">Tracer Study</div>
            <div class="card-body">
                <table class="table" style="table-layout: fixed; width:100%">
                    <thead>
                        <tr class="text-center align-middle">
                            <th style="width:5%;">No</th>
                            <th class="p-2">Nama Alumni</th>
                            <th class="p-1">NIM</th>
                            <th style="width:8%">Status</th>


                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>


                        @forelse($tracerstudy as $item)

                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ $item->mahasiswa->user->name }}</td>
                            <td class="align-middle">{{ $item->mahasiswa->nim }}</td>
                            <td class="align-middle">{{ $item->status_saat_ini }}</td>

                            <td>

                                <form action="{{ route('tracer-study.destroy', $item->id) }}" method="POST" class="btn-group">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route('tracer-study.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                                    @can('delete-tracerstudy')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>

                        </tr>
                        \
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 mx-5">
                {{ $tracerstudy->links() }}
            </div>

        </div>
    </div>
</div>

@endsection