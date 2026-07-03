@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(!Auth::user()->hasRole('Mahasiswa'))
    <div class="card mb-4 border-0 shadow-sm bg-light">
        <div class="card-body">

            <form method="GET" action="{{ route('aktivitas.index') }}" id="formFilter" class="row align-items-end">
                <div class="col-md-5 mb-2">
                    <label class="small font-weight-bold text-secondary">Cari Mahasiswa</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm"
                            placeholder="Ketik NIM atau Nama..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <label class="small font-weight-bold text-secondary">Periode Akademik</label>
                    <select name="periode" class="form-control form-control-sm" onchange="document.getElementById('formFilter').submit();">
                        <option value="">-- Semua Periode --</option>
                        <option value="2025/2026 Ganjil" {{ request('periode') == '2025/2026 Ganjil' ? 'selected' : '' }}>2025/2026 Ganjil</option>
                        <option value="2025/2026 Genap" {{ request('periode') == '2025/2026 Genap' ? 'selected' : '' }}>2025/2026 Genap</option>
                    </select>
                </div>

                <input type="hidden" name="status" id="filter_status" value="{{ request('status') }}">
                <input type="hidden" name="jenis" id="filter_jenis" value="{{ request('jenis') }}">

                <div class="col-md-3 mb-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary mr-2 w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('aktivitas.index') }}" class="btn btn-sm btn-secondary w-100 text-center">
                        <i class="fas fa-sync-alt"></i> Reset
                    </a>
                </div>
            </form>

            <hr class="my-2">

            <div class="d-flex flex-wrap align-items-center mt-2 small">
                <span class="font-weight-bold text-muted mr-2">Status Validasi:</span>
                <a href="javascript:void(0)" onclick="setQuickFilter('status', '')"
                    class="badge p-2 mr-2 {{ request('status') == '' ? 'badge-dark' : 'badge-white border text-dark' }}">
                    Semua
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('status', 'menunggu')"
                    class="badge p-2 mr-2 {{ request('status') == 'menunggu' ? 'badge-warning text-dark' : 'badge-white border text-dark' }}">
                    ⏳ Menunggu
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('status', 'valid')"
                    class="badge p-2 mr-2 {{ request('status') == 'valid' ? 'badge-success' : 'badge-white border text-dark' }}">
                    ✔ Valid
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('status', 'tidak_valid')"
                    class="badge p-2 mr-4 {{ request('status') == 'tidak_valid' ? 'badge-danger' : 'badge-white border text-dark' }}">
                    ❌ Tidak Valid
                </a>

                <span class="font-weight-bold text-muted mr-2">Jenis Kegiatan:</span>
                <a href="javascript:void(0)" onclick="setQuickFilter('jenis', '')"
                    class="badge p-2 mr-2 {{ request('jenis') == '' ? 'badge-dark' : 'badge-white border text-dark' }}">
                    Semua
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('jenis', 'AK')"
                    class="badge p-2 mr-2 {{ request('jenis') == 'AK' ? 'badge-info' : 'badge-white border text-dark' }}">
                    AK (Kemahasiswaan)
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('jenis', 'K')"
                    class="badge p-2 mr-2 {{ request('jenis') == 'K' ? 'badge-info' : 'badge-white border text-dark' }}">
                    K (Kompetisi)
                </a>
                <a href="javascript:void(0)" onclick="setQuickFilter('jenis', 'PKM')"
                    class="badge p-2 {{ request('jenis') == 'PKM' ? 'badge-info' : 'badge-white border text-dark' }}">
                    PKM (Kreativitas)
                </a>
            </div>
        </div>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            @if(auth()->user()->hasRole('Mahasiswa'))
            <i class="fas fa-users me-1"></i> Data Aktivitas
            @else
            <i class="fas fa-users me-1"></i> Seluruh Ajuan Aktivitas Mahasiswa
            @endif

            @if(auth()->user()->hasRole('Mahasiswa'))
            <div class="card-tools">
                <a href="{{ route('aktivitas.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah Aktivitas
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Kajur'))
            <a href="{{ route('aktivitas.cetak', request()->all()) }}" class="btn btn-success btn-sm mb-3" target="_blank">
                <i class="fas fa-print"></i> Cetak Laporan Rekap
            </a>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Nama Aktivitas</th>
                            <th>Tanggal</th>
                            <th>Poin Sistem</th>
                            <th>Status Validasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aktivitas as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->mahasiswa->user->name }}</td>
                            <td>{{ $row->mahasiswa->nim }}</td>
                            <td>{{ $row->nama_aktivitas }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal_mulai)->translatedFormat('d M Y') }}</td>
                            <td>{{ number_format($row->poin, 2) }}</td>
                            <td>
                                @if($row->status_validasi == 'menunggu')
                                <span class="badge badge-warning text-dark">Menunggu</span>
                                @elseif($row->status_validasi == 'valid')
                                <span class="badge badge-success">Valid</span>
                                @else
                                <span class="badge badge-danger">Tidak Valid</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                <div class="d-flex">

                                    @if(Auth::user()->hasRole('Admin'))
                                    <button type="button" class="btn btn-warning btn-sm mr-1"
                                        data-toggle="modal"
                                        data-target="#modalValidasi"
                                        data-id="{{ $row->id }}"
                                        data-nama="{{ $row->nama_aktivitas }}"
                                        data-mahasiswa="{{ $row->mahasiswa->user->name }}"
                                        data-poin="{{ $row->poin }}"
                                        data-status="{{ $row->status_validasi }}"
                                        data-catatan="{{ $row->catatan_admin }}">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    @endif

                                    <button type="button" class="btn btn-info btn-sm text-white"
                                        data-toggle="modal"
                                        data-target="#modalDetailAktivitas"
                                        data-nim="{{ $row->mahasiswa->nim }}"
                                        data-nama="{{ $row->mahasiswa->user->name }}"
                                        data-periode="{{ $row->periode_akademik }}"
                                        data-jenis-aktivitas="{{ $row->jenis_aktivitas }}"
                                        data-kelompok-aktivitas="{{ $row->kelompok_aktivitas }}"
                                        data-nama-aktivitas="{{ $row->nama_aktivitas }}"
                                        data-tingkat-prestasi="{{ $row->tingkat_prestasi }}"
                                        data-peringkat="{{ $row->peringkat ?? '-' }}"
                                        data-jenis-prestasi="{{ $row->jenis_prestasi ?? '-' }}"
                                        data-jabatan="{{ $row->jabatan ?? '-' }}"
                                        data-penyelenggara="{{ $row->penyelenggara ?? '-' }}"
                                        data-lokasi-aktivitas="{{ $row->lokasi_aktivitas ?? '-' }}"
                                        data-tglmulai="{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}"
                                        data-jenis-dokumen-pendukung="{{ $row->jenis_dokumen_pendukung }}"
                                        data-poin="{{ number_format($row->poin, 2) }}"
                                        data-status="{{ $row->status_validasi }}"
                                        data-catatan="{{ $row->catatan_admin ?? '-' }}"
                                        data-berkas="{{ asset('uploads/dokumen_aktivitas/' . $row->dokumen_pendukung) }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada ajuan aktivitas masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalValidasi" tabindex="-1" role="dialog" aria-labelledby="modalValidasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalValidasiLabel">Form Validasi Aktivitas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formValidasi" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <p class="mb-1"><strong>Mahasiswa:</strong> <span id="text_mahasiswa"></span></p>
                    <p class="mb-3"><strong>Aktivitas:</strong> <span id="text_aktivitas"></span></p>
                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Input Poin SKCPAM <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="poin" id="input_poin" class="form-control" placeholder="Contoh: 5.50" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Validasi <span class="text-danger">*</span></label>
                        <select name="status_validasi" id="input_status" class="form-control" required>
                            <option value="valid">VALID (Setujui)</option>
                            <option value="tidak_valid">TIDAK VALID (Tolak)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Admin (Alasan jika Ditolak)</label>
                        <textarea name="catatan_admin" id="input_catatan" class="form-control" rows="3" placeholder="Contoh: Berkas blur / sertifikat tidak sesuai tema"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailAktivitas" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalDetailLabel"><i class="fas fa-info-circle"></i> Detail Lengkap Aktivitas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered m-0">
                    <tr>
                        <th width="35%">Nama Mahasiswa</th>
                        <td id="det_nama"></td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td id="det_nim"></td>
                    </tr>
                    <tr>
                        <th>Periode Akademik</th>
                        <td id="det_periode"></td>
                    </tr>
                    <tr>
                        <th>Jenis Aktivitas</th>
                        <td><span class="badge badge-secondary" id="det_jenis_aktivitas"></span></td>
                    </tr>
                    <tr>
                        <th>Kelompok Aktivitas</th>
                        <td id="det_kelompok_aktivitas"></td>
                    </tr>
                    <tr>
                        <th>Nama Aktivitas</th>
                        <td id="det_nama_aktivitas"></td>
                    </tr>
                    <tr>
                        <th>Tingkat Prestasi</th>
                        <td id="det_tingkat_prestasi"></td>
                    </tr>
                    <tr>
                        <th>Peringkat</th>
                        <td id="det_peringkat"></td>
                    </tr>
                    <tr>
                        <th>Jenis Prestasi</th>
                        <td id="det_jenis_prestasi"></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td id="det_jabatan"></td>
                    </tr>
                    <tr>
                        <th>Penyelenggara</th>
                        <td id="det_penyelenggara"></td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td id="det_lokasi_aktivitas"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td><span id="det_tglmulai"></span></td>
                    </tr>
                    <tr>
                        <th>Jenis Dokumen Pendukung</th>
                        <td id="det_jenis_dokumen_pendukung"></td>
                    </tr>
                    <tr>
                        <th>Poin</th>
                        <td class="text-primary font-weight-bold" id="det_poin"></td>
                    </tr>
                    <tr>
                        <th>Status Validasi</th>
                        <td id="det_status"></td>
                    </tr>
                    <tr>
                        <th>Catatan Admin</th>
                        <td id="det_catatan" class="text-danger"></td>
                    </tr>
                    <tr>
                        <th>Dokumen Pendukung</th>
                        <td>
                            <a href="" id="det_berkas" class="btn btn-sm btn-outline-primary" target="_blank">
                                <i class="fas fa-file-download"></i> Buka Dokumen Pendukung
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Logika Pengisian data Modal Validasi (Proses)
        $('#modalValidasi').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nama = button.data('nama');
            var mahasiswa = button.data('mahasiswa');
            var poin = button.data('poin');
            var status = button.data('status');
            var catatan = button.data('catatan');

            $('#text_mahasiswa').text(mahasiswa);
            $('#text_aktivitas').text(nama);
            $('#input_poin').val(poin);
            $('#input_status').val(status === 'menunggu' ? 'valid' : status);
            $('#input_catatan').val(catatan);

            $('#formValidasi').attr('action', '/aktivitas/' + id);
        });

        // Logika Pengisian data Modal View Detail (Mata)
        $('#modalDetailAktivitas').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            $('#det_nama').text(button.data('nama'));
            $('#det_nim').text(button.data('nim'));
            $('#det_periode').text(button.data('periode'));

            // --- LOGIKA MENGUBAH SINGKATAN MENJADI TEKS PANJANG ---
            var jenisMentah = button.data('jenis-aktivitas');
            var jenisPanjang = jenisMentah; // default jika tidak cocok

            if (jenisMentah === 'AK') {
                jenisPanjang = 'Aktivitas Kemahasiswaan';
            } else if (jenisMentah === 'K') {
                jenisPanjang = 'Kompetisi';
            } else if (jenisMentah === 'PKM') {
                jenisPanjang = 'Program Kreativitas Mahasiswa';
            }
            $('#det_jenis_aktivitas').text(jenisPanjang);
            // -----------------------------------------------------

            $('#det_kelompok_aktivitas').text(button.data('kelompok-aktivitas'));
            $('#det_nama_aktivitas').text(button.data('nama-aktivitas'));
            $('#det_tingkat_prestasi').text(button.data('tingkat-prestasi'));
            $('#det_peringkat').text(button.data('peringkat'));
            $('#det_jenis_prestasi').text(button.data('jenis-prestasi'));
            $('#det_jabatan').text(button.data('jabatan'));
            $('#det_penyelenggara').text(button.data('penyelenggara'));
            $('#det_lokasi_aktivitas').text(button.data('lokasi-aktivitas'));
            $('#det_tglmulai').text(button.data('tglmulai'));
            $('#det_jenis_dokumen_pendukung').text(button.data('jenis-dokumen-pendukung'));
            $('#det_poin').text(button.data('poin'));
            $('#det_catatan').text(button.data('catatan'));
            $('#det_berkas').attr('href', button.data('berkas'));

            // Memperbaiki tampilan badge Status Validasi secara dinamis
            var status = button.data('status');
            if (status === 'valid') {
                $('#det_status').html('<span class="badge badge-success">Valid</span>');
            } else if (status === 'menunggu') {
                $('#det_status').html('<span class="badge badge-warning text-dark">Menunggu</span>');
            } else {
                $('#det_status').html('<span class="badge badge-danger">Tidak Valid</span>');
            }
        });
    });

    // Logika Quick Filter Badges
    function setQuickFilter(type, value) {
        if (type === 'status') {
            document.getElementById('filter_status').value = value;
        } else if (type === 'jenis') {
            document.getElementById('filter_jenis').value = value;
        }
        document.getElementById('formFilter').submit();
    }
</script>
@endsection