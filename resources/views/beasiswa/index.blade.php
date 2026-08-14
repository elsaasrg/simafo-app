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
                <form action="{{ route('beasiswa.index') }}" method="GET" class="form-row align-items-end">

                    <div class="col-md-3 mb-2">
                        <label class="font-weight-bold small ">Cari Data Beasiswa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" name="search" class="form-control border-left-0" value="{{ request('search') }}" placeholder="Nama, NIM, atau Penyelenggara...">
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
                        <div class="d-flex align-items-center justify-content-end" style="gap: 5px;">

                            <button type="submit" class="btn btn-primary btn-sm btn-radius px-3">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>

                            <a href="{{ route('beasiswa.index') }}" class="btn btn-sm bg-abu-abu btn-radius px-3 text-white">
                                <i class="fas fa-sync-alt mr-1"></i> Reset
                            </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        @endif
        {{-- ======================================================================================== --}}
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h4 class="font-weight-bold"> <i class="fas fa-sitemap mr-2"></i> DATA BEASISWA</h4>
                    </div>
                    <div class="col-md-3">
                        @if(Auth::user()->hasRole('Mahasiswa'))
                        <a href="{{ route('beasiswa.create') }}" class="btn btn-success btn-sm btn-radius">
                            <i class="fas fa-plus-circle "></i> Tambah data beasiswa
                        </a>
                        @endif
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur'))
                            <a href="{{ route('beasiswa.cetak', request()->all()) }}" class="btn btn-success btn-sm mb-3 btn-radius" target="_blank">
                                <i class="fas fa-print"></i> Cetak Laporan Terfilter
                            </a>

                            @endif

                            <tr class="text-center align-middle">
                                <th style="width:5%;">No</th>
                                @if(!Auth::user()->hasRole('Mahasiswa'))
                                <th style="width:10%;">Mahasiswa</th>
                                @endif
                                <th>Nama Beasiswa</th>
                                <th>Penyelenggara</th>
                                <th>Nominal/Skema Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Bukti Penerima</th>
                                <th>Status Validasi</th>
                                <th style="width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beasiswa as $item)
                            <tr class="text-center align-middle">
                                <td class="align-middle font-weight-bold">{{ $loop->iteration }}</td>

                                @if(!Auth::user()->hasRole('Mahasiswa'))
                                <td class="align-middle text-left pl-3">{{ $item->mahasiswa->user->name }}<br>
                                    {{ $item->mahasiswa->nim }}
                                </td>
                                @endif

                                <td class="align-middle text-left pl-3">
                                    {{ $item->nama_beasiswa }}
                                    @if($item->catatan_admin)
                                    <br><small class="text-danger">Catatan: {{ $item->catatan_admin }}</small>
                                    @endif
                                </td>

                                <td class="align-middle">{{ $item->penyelenggara }}</td>
                                <td class="align-middle">
                                    Rp{{ number_format($item->nominal, 0, ',', '.') }}<br>
                                    <small>{{ $item->skema_pembayaran }}</small>
                                </td>

                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                </td>

                                <td class="align-middle">
                                    @if($item->bukti_penerima)
                                    <a href="{{ asset('storage/' . $item->bukti_penerima) }}" target="_blank" class="btn btn-link btn-sm p-0">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                    <br>
                                    <span class="small">Lihat bukti penerima</span>
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
                                            data-toggle="modal" data-target="#modalValidasiBeasiswa"
                                            data-id="{{ $item->id }}"
                                            data-beasiswa="{{ $item->nama_beasiswa }}"
                                            data-mahasiswa="{{ $item->mahasiswa->user->name }}"
                                            data-status="{{ $item->status_validasi }}"
                                            data-catatan="{{ $item->catatan_admin }}">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        @endif

                                        @if(Auth::user()->hasRole('Mahasiswa') && $item->status_validasi !== 'diterima')
                                        <a href="{{ route('beasiswa.edit', $item->id) }}" class="btn bg-yellow-1 btn-sm btn-radius">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('beasiswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm px-2 btn-radius">
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
            <div class="modal-header bg-yellow-4 text-center">
                <div class="row justify-content-center align-items-center w-100">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h5 class=""><i class="fas fa-check-circle text-warning mr-1"></i> Form Validasi Beasiswa</h5>
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
                    <button type="submit" class="btn btn-primary btn-sm btn-radius">Simpan</button>
                    <button type="button" class="btn bg-dark btn-sm btn-radius text-white" data-dismiss="modal">Batal</button>
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