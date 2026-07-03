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
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                {{-- Tombol Edit & Hapus HANYA muncul jika statusnya 'dikirim' --}}
                                @if($item->status == 'dikirim')
                                <a href="{{ route('konseling.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm mx-1"
                                    style="padding: .25rem .4rem;"
                                    title="Edit Pengajuan">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('konseling.destroy', $item->id) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus pengajuan konseling ini?');"
                                        class="btn btn-danger btn-sm"
                                        style="padding: .25rem .4rem;"
                                        title="Hapus Pengajuan">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif

                                {{-- Tombol Detail selalu muncul di semua status --}}
                                <a href="{{ route('konseling.show', $item->id) }}"
                                    class="btn btn-primary btn-sm mx-1"
                                    style="padding: .25rem .4rem;"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
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