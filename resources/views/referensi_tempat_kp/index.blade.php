@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Notifikasi Sukses / Gagal --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold text-dark mb-0">Informasi Tempat Kerja Praktik & Mitra Jurusan</h2>
            <p class="text-muted small">Referensi lokasi Kerja Praktik untuk mahasiswa</p>
        </div>
    </div>

    {{-- ================= TABEL 1: MITRA JURUSAN ================= --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-success text-white font-weight-bold d-flex justify-content-between align-items-center py-2">
            <span>Daftar Perusahaan Mitra Jurusan</span>
            {{-- Tombol Tambah Mitra Hanya Muncul untuk Admin --}}
            @if(Auth::check() && Auth::user()->hasRole('Admin'))
            <button class="btn btn-light btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahMitra">+ Tambah Mitra</button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm small">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Perusahaan / Instansi</th>
                            <th width="35%">Alamat</th>
                            <th width="20%">Deskripsi</th>
                            @if(Auth::check() && Auth::user()->hasRole('Admin'))
                            <th width="15%">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mitraJurusan as $index => $mitra)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-weight-bold text-success">{{ $mitra->nama_perusahaan }}</td>
                            <td>{{ $mitra->alamat }}</td>
                            <td><small class="text-muted">{{ $mitra->deskripsi ?? '-' }}</small></td>
                            {{-- Kolom Aksi Hanya Muncul untuk Admin --}}
                            @if(Auth::check() && Auth::user()->hasRole('Admin'))
                            <td>
                                <button class="btn btn-warning btn-sm py-0 shadow-sm" data-toggle="modal" data-target="#modalEditMitra{{ $mitra->id }}">Edit</button>
                                <form action="{{ route('mitra-jurusan.destroy', $mitra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus mitra ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm py-0 shadow-sm">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>

                        {{-- MODAL EDIT MITRA (HANYA UNTUK ADMIN) --}}
                        @if(Auth::check() && Auth::user()->hasRole('Admin'))
                        <div class="modal fade" id="modalEditMitra{{ $mitra->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('mitra-jurusan.update', $mitra->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title font-weight-bold">Edit Data Mitra</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label>Nama Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control" value="{{ $mitra->nama_perusahaan }}" required></div>
                                            <div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control" rows="3" required>{{ $mitra->alamat }}</textarea></div>
                                            <div class="form-group"><label>Keterangan</label><textarea name="keterangan" class="form-control" rows="2">{{ $mitra->keterangan }}</textarea></div>
                                        </div>
                                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning font-weight-bold">Simpan Perubahan</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                        <tr>
                            <td colspan="{{ Auth::check() && Auth::user()->hasRole('Admin') ? '5' : '4' }}" class="text-center text-muted py-3">Belum ada data mitra resmi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- =================  TABEL 2: TEMPAT KP ================= --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white font-weight-bold d-flex justify-content-between align-items-center py-2">
            <span> Riwayat Lokasi & Tempat KP Mahasiswa</span>
            {{-- Tombol Tambah Tempat KP Hanya Muncul untuk Admin --}}
            @if(Auth::check() && Auth::user()->hasRole('Admin'))
            <button class="btn btn-light btn-sm font-weight-bold text-dark" data-toggle="modal" data-target="#modalTambahTempat">+ Tambah Tempat KP</button>
            @endif
        </div>
        <div class="card-body">
            <!-- <p class="text-muted small mb-3">*Gunakan kolom pencarian di sebelah kanan untuk menyaring data lokasi secara instan.</p> -->
            <div class="table-responsive">
                <table id="tabelTempatKp" class="table table-striped table-bordered table-sm small" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Tempat / Perusahaan</th>
                            <th width="25%">Alamat</th>
                            <th width="20%">Tahun Pelaksanaan KP</th>
                            <th width="15%">Deskripsi / Catatan</th>
                            @if(Auth::check() && Auth::user()->hasRole('Admin'))
                            <th width="10%">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tempatKp as $index => $kp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-weight-bold text-dark">{{ $kp->nama_perusahaan }}</td>
                            <td>{{ $kp->alamat }}</td>
                            <td><span class="badge badge-secondary">{{ $kp->tahun_kp ?? '-' }}</span></td>
                            <td><small class="text-muted">{{ $kp->deskripsi ?? 'Tersedia' }}</small></td>
                            {{-- Kolom Aksi Hanya Muncul untuk Admin --}}
                            @if(Auth::check() && Auth::user()->hasRole('Admin'))
                            <td>
                                <button class="btn btn-warning btn-sm py-0 shadow-sm" data-toggle="modal" data-target="#modalEditTempat{{ $kp->id }}">Edit</button>
                                <form action="{{ route('tempat-kp.destroy', $kp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data riwayat tempat KP ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm py-0 shadow-sm">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>

                        {{-- MODAL EDIT TEMPAT KP (HANYA UNTUK ADMIN) --}}
                        @if(Auth::check() && Auth::user()->hasRole('Admin'))
                        <div class="modal fade" id="modalEditTempat{{ $kp->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('tempat-kp.update', $kp->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title font-weight-bold">Edit Data Tempat KP</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label>Nama Instansi / Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control" value="{{ $kp->nama_perusahaan }}" required></div>
                                            <div class="form-group"><label>Alamat / Kota</label><textarea name="alamat" class="form-control" rows="3" required>{{ $kp->alamat }}</textarea></div>
                                            <div class="form-group"><label>Tahun KP</label><input type="number" name="tahun_kp" class="form-control" value="{{ $kp->tahun_kp }}"></div>
                                            <div class="form-group"><label>Deskripsi / Catatan</label><textarea name="deskripsi" class="form-control" rows="2">{{ $kp->deskripsi }}</textarea></div>
                                        </div>
                                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="submit" class="btn btn-dark font-weight-bold">Simpan Perubahan</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH DATA (HANYA UNTUK ADMIN) ================= --}}
@if(Auth::check() && Auth::user()->hasRole('Admin'))
{{-- MODAL TAMBAH MITRA --}}
<div class="modal fade" id="modalTambahMitra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('mitra-jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold">Tambah Mitra Resmi</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Nama Perusahaan / Instansi</label><input type="text" name="nama_perusahaan" class="form-control" placeholder="Contoh: PT. Telkom" required></div>
                    <div class="form-group"><label>Alamat Lengkap</label><textarea name="alamat" class="form-control" rows="3" placeholder="Alamat instansi..." required></textarea></div>
                    <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" rows="2" placeholder="Opsional.."></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="submit" class="btn btn-success font-weight-bold">Simpan Data</button></div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH TEMPAT KP --}}
<div class="modal fade" id="modalTambahTempat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tempat-kp.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold">Tambah Tempat KP</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Nama Instansi / Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control" placeholder="Contoh: Bank Kalbar" required></div>
                    <div class="form-group"><label>Alamat / Kota</label><textarea name="alamat" class="form-control" rows="3" placeholder="Lokasi perusahaan..." required></textarea></div>
                    <div class="form-group"><label>Tahun KP</label><input type="number" name="tahun_kp" class="form-control" placeholder="Contoh: 2026"></div>
                    <div class="form-group"><label>Deskripsi / Catatan Tambahan</label><textarea name="deskripsi" class="form-control" rows="2" placeholder="Opsional..."></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="submit" class="btn btn-dark font-weight-bold">Simpan Data</button></div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- ================= ⚙️ SCRIPT DATATABLES ================= --}}
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelTempatKp').DataTable({
            "pageLength": 10,
            "language": {
                "search": "Cari Tempat KP:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
                "paginate": {
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });
    });
</script>
@endpush
@endsection