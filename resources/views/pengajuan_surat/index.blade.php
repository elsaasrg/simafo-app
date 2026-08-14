@extends('layouts.app')
@section('content')


<h4 class="font-weight-bold text-center mb-3"><i class="fas fa-envelope mr-1"></i>PENGAJUAN SURAT</h4>

<div class="content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header card-outline-yellow">
                <div class="row w-100">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="font-weight-bold m-0"><i class="fas fa-edit mr-1"></i>Daftar Riwayat Pengajuan</h5>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center justify-content-md-end">
                        @if(auth()->user()->hasRole('Mahasiswa'))
                        <a href="{{ route('pengajuan-surat.create') }}" class="btn text-white btn-sm shadow-sm btn-success btn-radius m-0">
                            <i class="fas fa-plus"></i> Ajukan Surat Baru
                        </a>
                        @endif
                    </div>
                </div>
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
                            @if(auth()->user()->hasRole('Admin'))
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
                                <span class="badge badge-dark">{{ $item->mahasiswa->nim ?? 'NIM' }}</span>
                            </td>
                            @endif
                            <td>{{ $item->jenis_surat }}</td>
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
                                <span class="badge badge-warning text-dark px-2 py-1 btn-radius">Menunggu Validasi</span>
                                @elseif($item->status == 'diproses')
                                <span class="badge bg-yellow-1 px-2 py-1 btn-radius">Sedang Diproses</span>
                                @elseif($item->status == 'selesai')
                                <span class="badge btn-success px-2 py-1 btn-radius">Selesai</span>
                                @else
                                <span class="badge badge-danger px-2 py-1 btn-radius">Ditolak</span>
                                @endif

                                @if($item->keterangan_admin)
                                <br><small class="text-muted"><b>Ket:</b> {{ $item->keterangan_admin }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->file_surat_keluar && $item->status == 'selesai')
                                <a href="{{ asset('uploads/surat_keluar/' . $item->file_surat_keluar) }}" target="_blank" class="btn btn-sm bg-success shadow-sm btn-radius">
                                    <span class="text-nowrap"><i class="fas fa-download"></i> Unduh Surat</span>
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
                                                <div class="modal-header bg-yellow-2">
                                                    <div class="row d-flex justify-content-center align-items-center w-100">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <h5 class=""><i class="fas fa-tasks"></i> Proses Surat Mahasiswa</h5>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Ubah Status</label>
                                                        <select name="status" class="form-control custom-select status-select" data-id="{{ $item->id }}" required>
                                                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses (Sedang Dimintakan TTD)</option>
                                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai (Unggah Berkas Jadi)</option>
                                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Tolak Permohonan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Catatan / Alasan Penolakan</label>
                                                        <textarea name="keterangan_admin" class="form-control" rows="2" placeholder="Tulis catatan jika dokumen ditolak...">{{ $item->keterangan_admin }}</textarea>
                                                    </div>

                                                    <div class="form-group" id="uploadSuratWrapper{{ $item->id }}" style="display: none;">
                                                        <label class="font-weight-bold">Unggah Surat Resmi (Format .pdf jika Selesai)</label>
                                                        <input type="file" name="file_surat_keluar" class="form-control-file" accept="application/pdf">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm btn-radius">Simpan</button>
                                                    <button type="button" class="btn btn-default btn-sm btn-radius bg-dark text-white" data-dismiss="modal">Batal</button>
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusSelects = document.querySelectorAll('.status-select');

        statusSelects.forEach(function(select) {
            const itemId = select.getAttribute('data-id');
            const wrapper = document.getElementById('uploadSuratWrapper' + itemId);

            function toggleUploadInput() {
                if (select.value === 'selesai') {
                    wrapper.style.display = 'block';
                } else {
                    wrapper.style.display = 'none';
                }
            }

            toggleUploadInput();
            select.addEventListener('change', toggleUploadInput);
        });
    });
</script>
@endsection