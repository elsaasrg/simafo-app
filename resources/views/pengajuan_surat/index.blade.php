@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-purple"><i class="fas fa-envelope shadow-sm p-1 rounded bg-purple-light"></i>Pengajuan Surat</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
            {{ session('success') }}
        </div>
        @endif

        <div class="card card-purple card-outline shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold">Daftar Riwayat Pengajuan</h3>
                @if(auth()->user()->hasRole('Mahasiswa'))
                <a href="{{ route('pengajuan-surat.create') }}" class="btn bg-purple text-white btn-sm ml-auto shadow-sm">
                    <i class="fas fa-plus"></i> Ajukan Surat Baru
                </a>
                @endif
            </div>

            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th style="width: 40px">No</th>
                            @if(!auth()->user()->hasRole('Mahasiswa'))
                            <th>Mahasiswa</th>
                            @endif
                            <th>Jenis Surat</th>
                            <th>Maksud / Keperluan</th>
                            <th>Berkas Persyaratan (Lampiran)</th>
                            <th>Status Proses</th>
                            <th>Surat Resmi Jadi</th>
                            @if(auth()->user()->role == 'admin')
                            <th style="width: 100px">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuan_surat as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @if(!auth()->user()->hasRole('Mahasiswa'))
                            <td>
                                {{ $item->mahasiswa->user->name ?? 'Nama Tidak Ada' }}<br>
                                <span class="badge badge-secondary">{{ $item->mahasiswa->nim ?? 'NIM' }}</span>
                            </td>
                            @endif
                            <td><span class="text-purple font-weight-bold">{{ $item->jenis_surat }}</span></td>
                            <td>{{ $item->keperluan }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    @foreach($item->lampiranSurat as $no => $lampiran)
                                    <a href="{{ asset('uploads/lampiran_surat/' . $lampiran->nama_file) }}" target="_blank" class="btn btn-xs btn-outline-secondary text-left text-truncate mb-1" style="max-width: 170px;">
                                        <i class="fas fa-file-alt"></i> Dokumen {{ $no + 1 }}
                                    </a>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @if($item->status == 'menunggu')
                                <span class="badge badge-warning text-dark px-2 py-1">Menunggu Validasi</span>
                                @elseif($item->status == 'diproses')
                                <span class="badge badge-info px-2 py-1">Sedang Diproses</span>
                                @elseif($item->status == 'selesai')
                                <span class="badge badge-success px-2 py-1">Selesai</span>
                                @else
                                <span class="badge badge-danger px-2 py-1">Ditolak</span>
                                @endif

                                @if($item->keterangan_admin)
                                <br><small class="text-muted"><b>Ket:</b> {{ $item->keterangan_admin }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->file_surat_keluar)
                                <a href="{{ asset('uploads/surat_keluar/' . $item->file_surat_keluar) }}" target="_blank" class="btn btn-sm bg-success shadow-sm">
                                    <i class="fas fa-download"></i> Unduh Surat Resmi
                                </a>
                                @else
                                <span class="text-muted small"><em>Belum diterbitkan</em></span>
                                @endif
                            </td>
                            @if(auth()->user()->hasRole('Admin'))
                            <td>
                                <button class="btn btn-warning btn-xs font-weight-bold shadow-sm" data-toggle="modal" data-target="#prosesSuratModal{{ $item->id }}">
                                    <i class="fas fa-cog"></i> Proses
                                </button>

                                <div class="modal fade" id="prosesSuratModal{{ $item->id }}" data-backdrop="static" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('pengajuan-surat.updateStatus', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-purple text-white">
                                                    <h5 class="modal-title"><i class="fas fa-tasks"></i> Proses Surat Mahasiswa</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Ubah Status</label>
                                                        <select name="status" class="form-control custom-select" required>
                                                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses (Sedang Dimintakan TTD)</option>
                                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai (Unggah Berkas Jadi)</option>
                                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Tolak Permohonan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Catatan / Alasan Penolakan</label>
                                                        <textarea name="keterangan_admin" class="form-control" rows="2" placeholder="Tulis catatan jika dokumen ditolak...">{{ $item->keterangan_admin }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Unggah Surat Resmi(Format .pdf jika Selesai)</label>
                                                        <input type="file" name="file_surat_keluar" class="form-control-file" accept="application/pdf">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn bg-purple text-white">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada riwayat pengajuan surat masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection