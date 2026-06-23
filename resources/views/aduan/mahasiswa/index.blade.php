@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data aduan</h5>

            <a href="{{ route('aduan.create') }}"
                class="btn btn-primary btn-sm">
                Tambah aduan
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Subjek</th>

                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($aduan as $item)

                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->subjek }}
                        </td>



                        <td class="text-center">
                            <div class="badge bg-primary">{{ $item->status }}</div>
                        </td>

                        <td>
                            <div class="text-center">
                                @if($item->status == 'dikirim')

                                <form action="{{ route('mahasiswa.aduan.destroy', $item->id) }}" method="POST" class="btn-group">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route('mahasiswa.aduan.edit',$item->id) }}" class="btn btn-warning btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
                                <a href="{{ route('aduan.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada data aduan
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>

            {{ $aduan->links() }}

        </div>
    </div>
</div>

@endsection