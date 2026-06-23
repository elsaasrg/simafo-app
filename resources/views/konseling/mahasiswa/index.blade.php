@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Konseling</h5>

            <a href="{{ route('konseling.create') }}"
                class="btn btn-primary btn-sm">
                Tambah Konseling
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
                            <div class="badge bg-primary">{{ $item->status }}</div>
                        </td>

                        <td>
                            <div class="text-center">
                                @if($item->status == 'dikirim')

                                <form action="{{ route('konseling.destroy', $item->id) }}" method="POST" class="btn-group">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route('konseling.edit',$item->id) }}" class="btn btn-warning btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
                                <a href="{{ route('konseling.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

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

            {{ $konseling->links() }}

        </div>
    </div>
</div>

@endsection<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>