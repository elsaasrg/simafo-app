@extends('layouts.app')

@section('content')
<div class="container-fluid mb-3">
    <h4 class="font-weight-bold text-center "> TAMBAH PENGAJUAN SURAT</h4>

</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid" style="max-width: 800px;">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Card Khas AdminLTE (Warna Ungu) -->
        <div class="card  shadow">
            <div class="card-header bg-yellow-4 text-center">
                <h6 class="font-weight-bold m-0"><i class="fas fa-edit mr-1"></i>Formulir Permohonan Dokumen</h6>
            </div>

            <!-- /.card-header -->
            <!-- Form Start -->
            <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <!-- 1. Dropdown Jenis Surat -->
                    <div class="form-group">
                        <label for="jenis_surat_select" class="font-weight-bold">Jenis Surat Yang Diperlukan <span class="text-danger">*</span></label>
                        <select id="jenis_surat_select" name="jenis_surat" class="form-control custom-select" required onchange="cekJenisSurat(this.value)">
                            <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                            <option value="Surat Keterangan Aktif Kuliah">Surat Keterangan Aktif Kuliah</option>
                            <option value="Surat Pengantar Penelitian/Skripsi">Surat Pengantar Penelitian / Ambil Data Skripsi</option>
                            <option value="Surat Pengantar Kerja Praktik / Magang">Surat Pengantar Kerja Praktik / Magang</option>
                            <option value="Surat Pengantar Peminjaman Ruangan">Surat Pengantar Peminjaman Ruangan</option>
                            <option value="Surat Permohonan Kegaitan">Surat Permohonan Kegiatan</option>
                            <option value="Lainnya">-- Surat Lainnya (Ketik Manual) --</option>
                        </select>
                    </div>

                    <!-- 2. Input Manual (Awalnya Tersembunyi) -->
                    <div class="form-group" id="kolom_input_manual" style="display: none;">
                        <label for="jenis_surat_manual" class="font-weight-bold text-danger">Masukkan Nama Jenis Surat Lainnya <span class="text-danger">*</span></label>
                        <input type="text" id="jenis_surat_manual" class="form-control border-danger">
                    </div>

                    <!-- 3. Kolom Maksud / Keperluan -->
                    <div class="form-group">
                        <label class="font-weight-bold">Maksud / Keperluan Pengajuan <span class="text-danger">*</span></label>
                        <textarea name="keperluan" class="form-control" rows="3" placeholder="Contoh: Untuk keperluan syarat pendaftaran beasiswa" required>{{ old('keperluan') }}</textarea>
                    </div>

                    <!-- 4. Upload Berkas Banyak (Multi-Upload) -->
                    <div class="form-group">
                        <label class="font-weight-bold">Unggah Dokumen Lampiran (Bisa Pilih Banyak File) <span class="text-danger">*</span></label>
                        <p class="text-muted small mb-2">
                            *Silakan pilih satu atau beberapa berkas persyaratan sekaligus (Format PDF/Gambar maksimal 2MB per file).<br>
                            <strong>Tips:</strong> Tekan tombol <code>Ctrl</code> (Windows) atau <code>Cmd</code> (Mac) sambil klik file-file yang ingin diunggah bersamaan.
                        </p>
                        <div class="custom-file">
                            <input type="file" name="file_lampiran[]" class="form-control-file" accept="application/pdf,image/*" multiple required>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-white d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary text-white shadow-sm btn-radius px-2 mr-1">
                        Tambah
                    </button>
                    <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-sm btn-dark btn-radius px-3 text-white">
                        <span class="text-white">Batal</span>
                    </a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Logika JavaScript Taktis Elsa -->
<script>
    function cekJenisSurat(nilai) {
        var kolomManual = document.getElementById('kolom_input_manual');
        var selectSelect = document.getElementById('jenis_surat_select');
        var inputManual = document.getElementById('jenis_surat_manual');

        if (nilai === 'Lainnya') {
            kolomManual.style.display = 'block'; // Tampilkan input teks
            inputManual.setAttribute('name', 'jenis_surat'); // Alihkan name ke input teks
            selectSelect.removeAttribute('name'); // Hapus name dari select agar tidak bentrok
            inputManual.required = true;
            inputManual.focus();
        } else {
            kolomManual.style.display = 'none'; // Sembunyikan input teks
            selectSelect.setAttribute('name', 'jenis_surat'); // Kembalikan name ke select
            inputManual.removeAttribute('name');
            inputManual.required = false;
        }
    }
</script>
@endsection