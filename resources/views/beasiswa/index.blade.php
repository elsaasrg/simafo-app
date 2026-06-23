@extends('layouts.app')

@section('content')

{{ $errors }}

<div class="row justify-content-center">
    <div class="col m-4">
        {{-- Flash Message Berhasil --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="font-weight-bold"><i class="fas fa-sitemap mr-1"></i> Data Beasiswa</span>

                @if(Auth::user()->hasRole('Mahasiswa'))
                <a href="{{ route('beasiswa.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle"></i> Tambah data beasiswa
                </a>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr class="text-center align-middle">
                                <th style="width:5%;">No</th>
                                @if(!Auth::user()->hasRole('Mahasiswa'))
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                @endif
                                <th>Nama Beasiswa</th>
                                <th>Penyelenggara</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Bukti Penerima</th>
                                <th>Status Validasi</th>
                                <th style="width:15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beasiswa as $item)
                            <tr class="text-center align-middle">
                                <td class="align-middle font-weight-bold">{{ $loop->iteration }}</td>

                                @if(!Auth::user()->hasRole('Mahasiswa'))
                                <td class="align-middle text-left pl-3">{{ $item->mahasiswa->user->name }}</td>
                                <td class="align-middle">{{ $item->mahasiswa->nim }}</td>
                                @endif

                                <td class="align-middle text-left pl-3">
                                    {{ $item->nama_beasiswa }}
                                    @if($item->catatan_admin)
                                    <br><small class="text-danger">Catatan: {{ $item->catatan_admin }}</small>
                                    @endif
                                </td>

                                <td class="align-middle">{{ $item->penyelenggara }}</td>

                                <td class="align-middle">{{ $item->tanggal_mulai }}</td>
                                <td class="align-middle">{{ $item->tanggal_selesai }}</td>

                                <td class="align-middle">
                                    @if($item->bukti_penerima)
                                    <a href="{{ asset('storage/' . $item->bukti_penerima) }}" target="_blank" class="btn btn-link btn-sm p-0">
                                        <i class="fas fa-file-download"></i> Lihat bukti penerima
                                    </a>
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    @if($item->status_validasi == 'diterima')
                                    <span class="badge badge-success px-2 py-1">Diterima</span>
                                    @elseif($item->status_validasi == 'menunggu')
                                    <span class="badge badge-warning text-dark px-2 py-1">Menunggu</span>
                                    @else
                                    <span class="badge badge-danger px-2 py-1">Ditolak</span>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        @if(Auth::user()->hasRole('Admin'))
                                        <button type="button" class="btn btn-warning btn-sm mr-1 text-dark"
                                            data-toggle="modal" data-target="#modalValidasiBeasiswa"
                                            data-id="{{ $item->id }}"
                                            data-beasiswa="{{ $item->nama_beasiswa }}"
                                            data-mahasiswa="{{ $item->mahasiswa->user->name }}"
                                            data-status="{{ $item->status_validasi }}"
                                            data-catatan="{{ $item->catatan_admin }}">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        @endif

                                        @if(Auth::user()->hasRole('Mahasiswa'))
                                        <a href="{{ route('beasiswa.edit', $item->id) }}" class="btn btn-warning btn-sm text-white mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('beasiswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->hasRole('Mahasiswa') ? 8 : 10 }}" class="text-center text-muted py-4">
                                    Tidak ada data beasiswa yang tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 mx-5">
                {{ $beasiswa->links() }}
            </div>

        </div>
    </div>
</div>

{{-- ==================== TAMBAHAN KODE MODAL VALIDASI DI SINI ==================== --}}
<div class="modal fade" id="modalValidasiBeasiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="fas fa-check-circle text-warning mr-1"></i> Form Validasi Beasiswa</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formValidasi" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="mb-1"><strong>Mahasiswa:</strong> <span id="text_mahasiswa"></span></p>
                    <p class="mb-3"><strong>Beasiswa:</strong> <span id="text_beasiswa"></span></p>
                    <hr>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Status Validasi <span class="text-danger">*</span></label>
                        <select name="status_validasi" id="input_status" class="form-control" required>
                            <option value="menunggu">Menunggu</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="diterima">Diterima</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Catatan Admin (Alasan jika Ditolak)</label>
                        <textarea name="catatan_admin" id="input_catatan" class="form-control" rows="3" placeholder="Contoh: Berkas SK buram atau tidak sah"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JAVASCRIPT JQUERY UNTUK PASOK DATA KE FORM MODAL --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#modalValidasiBeasiswa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var mahasiswa = button.data('mahasiswa');
            var beasiswa = button.data('beasiswa');
            var status = button.data('status');
            var catatan = button.data('catatan');

            // Set tulisan info di modal
            $('#text_mahasiswa').text(mahasiswa);
            $('#text_beasiswa').text(beasiswa);

            // Set default value form input
            $('#input_status').val(status === 'menunggu' ? 'diterima' : status);
            $('#input_catatan').val(catatan);

            // Tembak URL action form ke updateStatus secara dinamis
            $('#formValidasi').attr('action', '/beasiswa/' + id + '/update-status');
        });
    });
</script>
{{-- ============================================================================== --}}

@endsection