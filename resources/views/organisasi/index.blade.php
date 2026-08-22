@extends('layouts.app')

@section('content')

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

        {{-- ==================== LOCK FILTER DAN CARI HANYA UNTUK ADMIN ==================== --}}
        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Kajur'))
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('organisasi.index') }}" method="GET" class="form-row align-items-end">

                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="font-weight-bold small">Cari Data Mahasiswa / Organisasi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" name="search" class="form-control border-left-0" value="{{ request('search') }}" placeholder="Ketik Nama, NIM, atau Nama Organisasi...">
                        </div>
                    </div>

                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="font-weight-bold small">Kategori Status Validasi</label>
                        <select name="status" class="form-control">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="font-weight-bold small">Kategori Tahun Mulai</label>
                        <select name="tahun" class="form-control">
                            <option value="semua" {{ request('tahun') == 'semua' ? 'selected' : '' }}>Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3 text-right">
                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">

                            <button type="submit" class="btn btn-sm btn-primary px-3 btn-radius">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>

                            <a href="{{ route('organisasi.index') }}" class="btn btn-sm btn-secondary px-3 btn-radius">
                                <i class="fas fa-sync-alt mr-1"></i> Reset
                            </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        @endif
        {{-- ======================================================================================== --}}
        <div class="card mb-4">
            <div class="card-header text-center font-weight-bold">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <i class="fas fa-sitemap me-1 fa-2x mr-2"></i>
                        <h4 class="font-weight-bold" style="display:inline-block"> DATA ORGANISASI </h4>
                    </div>
                    <div class="col-md-3">
                        @if(auth()->user()->hasRole('Mahasiswa'))

                        <a href="{{ route('organisasi.create') }}" class="btn btn-success btn-sm btn-radius">
                            <i class="fas fa-plus"></i> Tambah Organisasi
                        </a>

                        @endif
                    </div>
                </div>

            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            @hasanyrole('Admin|Kajur')
                            <a href="{{ route('organisasi.cetak', request()->all()) }}" target="_blank" class="btn btn-success btn-sm px-3 mb-3 btn-radius">
                                <i class="fas fa-print mr-1"></i> Cetak Laporan Terfilter
                            </a>
                            @endhasanyrole
                            <tr class="text-center align-middle">
                                <th style="width:5%;">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Nama Organisasi</th>
                                <th>Jabatan</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai</th>
                                <th>Dokumen</th>
                                <th>Status Validasi</th>
                                <th style="width:15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($organisasi as $item)
                            <tr class="text-center align-middle">
                                <td class="align-middle font-weight-bold">{{ $loop->iteration }}</td>


                                <td class="align-middle text-left pl-3">{{ $item->mahasiswa->user->name }}</td>
                                <td class="align-middle">{{ $item->mahasiswa->nim }}</td>


                                <td class="align-middle text-left pl-3">
                                    {{ $item->nama_organisasi }}
                                    @if($item->catatan_admin)
                                    <br><small class="text-danger">Catatan: {{ $item->catatan_admin }}</small>
                                    @endif
                                </td>

                                <td class="align-middle">{{ $item->jabatan }}</td>

                                <td class="align-middle">{{ $item->tahun_mulai }}</td>
                                <td class="align-middle">{{ $item->tahun_selesai }}</td>

                                <td class="align-middle">
                                    @if($item->dokumen)
                                    <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank" class="btn btn-link btn-sm p-0 text-dark">
                                        <i class="fas fa-file-download d-block text-primary"></i> Lihat Dokumen
                                    </a>
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    @if($item->status_validasi == 'diterima')
                                    <span class="badge badge-success px-2 py-1 btn-radius">Diterima</span>
                                    @elseif($item->status_validasi == 'menunggu')
                                    <span class="badge bg-yellow-1 text-dark px-2 py-1 btn-radius">Menunggu</span>
                                    @else
                                    <span class="badge badge-danger px-2 py-1 btn-radius">Ditolak</span>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    <div>
                                        @if(Auth::user()->hasRole('Admin'))
                                        <button type="button" class="btn bg-yellow-1 btn-sm mr-1 text-dark btn-radius"
                                            data-toggle="modal" data-target="#modalValidasiOrganisasi"
                                            data-id="{{ $item->id }}"
                                            data-organisasi="{{ $item->nama_organisasi }}"
                                            data-mahasiswa="{{ $item->mahasiswa->user->name }}"
                                            data-status_validasi="{{ $item->status_validasi }}"
                                            data-catatan="{{ $item->catatan_admin }}">
                                            <i class="fas fa-check-circle text-dark"></i>
                                        </button>
                                        @endif

                                        @if(Auth::user()->hasRole('Mahasiswa') && $item->status_validasi !== 'diterima')
                                        <a href="{{ route('organisasi.edit', $item->id) }}" class="btn bg-yellow-1 btn-sm btn-radius">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('organisasi.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" class="btn btn-danger btn-sm btn-radius btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->hasRole('Mahasiswa') ? 10 : 10 }}" class="text-center text-muted py-4">
                                    Tidak ada data organisasi yang tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 mx-5">
                {{ $organisasi->links() }}
            </div>

        </div>
    </div>
</div>

{{-- ==================== TAMBAHAN KODE MODAL VALIDASI DI SINI ==================== --}}
<div class="modal fade" id="modalValidasiOrganisasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow-4">
                <div class="row w-100 justify-content-center align-items-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h5><i class="fas fa-check-circle text-warning mr-1"></i> Form Validasi Organisasi</h5>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form id="formValidasi" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="mb-1"><strong>Nama:</strong> <span id="text_mahasiswa"></span></p>
                    <p class="mb-3"><strong>Organisasi:</strong> <span id="text_organisasi"></span></p>
                    <hr>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Status Validasi <span class="text-danger">*</span></label>
                        <select name="status_validasi" id="input_status_validasi" class="form-control" required>
                            <option value="menunggu">Menunggu</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="diterima">Diterima</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Catatan Admin (Alasan jika Ditolak)</label>
                        <textarea name="catatan_admin" id="input_catatan" class="form-control" rows="3" placeholder="Contoh: Berkas dokumen buram atau tidak sah"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-radius">Simpan</button>
                    <button type="button" class="btn bg-dark btn-sm btn-radius text-white" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@push('js')
<script>
    // Konfirmasi Hapus Data
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            let form = this.closest('.delete-form');

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data aktivitas ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush