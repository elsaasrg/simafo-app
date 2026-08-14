@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong class="d-block mb-1">Terjadi kesalahan input:</strong>
        <ul class="mb-0 pl-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h4 class="font-weight-bold text-center mb-3">TAMBAH DATA AKTIVITAS</h4>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header text-center bg-yellow-4 shadow-sm">
            <h6> <strong class="m-0"><i class="fas fa-edit me-2"></i>Form Pengajuan Aktivitas/Sertifikat</strong></h6>

        </div>
        <div class="card-body p-4">
            <form action="{{ route('aktivitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- BARIS 1: Periode & Jenis Aktivitas -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Periode Akademik <span class="text-danger">*</span></label>
                        <select name="periode_akademik" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Periode --</option>
                            <option value="2025/2026 Genap" {{ old('periode_akademik') == '2025/2026 Genap' ? 'selected' : '' }}>2025/2026 Genap</option>
                            <option value="2025/2026 Ganjil" {{ old('periode_akademik') == '2025/2026 Ganjil' ? 'selected' : '' }}>2025/2026 Ganjil</option>
                            <option value="2024/2025 Genap" {{ old('periode_akademik') == '2024/2025 Genap' ? 'selected' : '' }}>2024/2025 Genap</option>
                            <option value="2024/2025 Ganjil" {{ old('periode_akademik') == '2024/2025 Ganjil' ? 'selected' : '' }}>2024/2025 Ganjil</option>
                            <option value="2023/2024 Genap" {{ old('periode_akademik') == '2023/2024 Genap' ? 'selected' : '' }}>2023/2024 Genap</option>
                            <option value="2023/2024 Ganjil" {{ old('periode_akademik') == '2023/2024 Ganjil' ? 'selected' : '' }}>2023/2024 Ganjil</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Jenis Aktivitas <span class="text-danger">*</span></label>
                        <select name="jenis_aktivitas" id="jenis_aktivitas" class="form-control" required onchange="jalankanPerubahan()">
                            <option value="" disabled selected>-- Pilih Jenis Aktivitas --</option>
                            <option value="Aktivitas Kemahasiswaan">AK (Aktivitas Kemahasiswaan)</option>
                            <option value="Kompetisi">K (Kompetisi / Prestasi)</option>
                            <option value="Program Kreativitas Mahasiswa">PKM (Program Kreativitas Mahasiswa)</option>
                        </select>
                    </div>
                </div>

                <!-- BARIS 2: Kelompok Aktivitas & Nama Aktivitas -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Kelompok Aktivitas <span class="text-danger">*</span></label>
                        <select name="kelompok_aktivitas" id="kelompok_aktivitas" class="form-control" required disabled>
                            <option value="" disabled selected>-- Pilih Jenis Aktivitas Dahulu --</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Nama Aktivitas / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aktivitas" class="form-control" value="{{ old('nama_aktivitas') }}" placeholder="Contoh: Seminar Nasional Teknologi Informasi" required>
                    </div>
                </div>

                <!-- BARIS 3: Jenis Kegiatan (Radio) -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label font-weight-bold d-block">Jenis Kegiatan <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kegiatan" id="akademik" value="Akademik" {{ old('jenis_kegiatan') == 'Akademik' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="akademik">Akademik</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kegiatan" id="non_akademik" value="Non Akademik" {{ old('jenis_kegiatan') == 'Non Akademik' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="non_akademik">Non Akademik</label>
                        </div>
                    </div>
                </div>

                <!-- FORM TAMBAHAN KHUSUS KOMPETISI (Dinamis via JS) -->
                <div class="row d-none" id="form_tambahan_prestasi">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Jenis Prestasi</label>
                        <select name="jenis_prestasi" class="form-control">
                            <option value="" selected>-- Pilih Jenis Prestasi --</option>
                            <option value="Sains">Sains</option>
                            <option value="Seni">Seni</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>

                    <!-- NAMA INPUT DIPERBAIKI MENJADI 'peringkat' -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Peringkat / Juara</label>
                        <select name="peringkat" class="form-control">
                            <option value="" selected>-- Pilih Peringkat --</option>
                            <option value="Juara 1">Juara 1</option>
                            <option value="Juara 2">Juara 2</option>
                            <option value="Juara 3">Juara 3</option>
                            <option value="Medali Emas">Medali Emas</option>
                            <option value="Medali Perak">Medali Perak</option>
                            <option value="Medali Perunggu">Medali Perunggu</option>
                            <option value="Juara Harapan 1">Juara Harapan 1</option>
                            <option value="Juara Harapan 2">Juara Harapan 2</option>
                            <option value="Juara Harapan 3">Juara Harapan 3</option>
                            <option value="Best Performance">Best Performance</option>
                            <option value="Peserta/Delegasi">Peserta/Delegasi</option>
                            <option value="Finalis">Finalis</option>
                        </select>
                    </div>
                </div>

                <!-- BARIS 4: Tingkat, Jabatan, Penyelenggara, Lokasi -->
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label font-weight-bold">Tingkat Prestasi / Aktivitas <span class="text-danger">*</span></label>
                        <select name="tingkat_prestasi" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Tingkat --</option>
                            <option value="Sekolah">Sekolah</option>
                            <option value="Kecamatan">Kecamatan</option>
                            <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Regional">Regional</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label font-weight-bold">Jabatan / Peran</label>
                        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" placeholder="Contoh: Ketua / Anggota">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label font-weight-bold">Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara') }}" placeholder="Contoh: Universitas Tanjungpura">
                    </div>

                    <!-- NAMA INPUT DIPERBAIKI MENJADI 'lokasi_aktivitas' -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label font-weight-bold">Lokasi Aktivitas</label>
                        <input type="text" name="lokasi_aktivitas" class="form-control" value="{{ old('lokasi_aktivitas') }}" placeholder="Contoh: Online / Pontianak">
                    </div>
                </div>

                <!-- BARIS 5: Tanggal Mulai & Tanggal Selesai -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
                    </div>
                </div>

                <!-- BARIS 6: Dokumen Pendukung -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Jenis Dokumen Pendukung <span class="text-danger">*</span></label>
                        <select name="jenis_dokumen_pendukung" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Jenis Dokumen --</option>
                            <option value="Dokumentasi/ Foto Kegiatan">Dokumentasi/ Foto Kegiatan</option>
                            <option value="SK Kegiatan/ Surat Tugas">SK Kegiatan/ Surat Tugas</option>
                            <option value="Sertifikat Kegiatan">Sertifikat Kegiatan</option>
                            <option value="Undangan Kegiatan (Finalis)">Undangan Kegiatan (Finalis)</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Upload Dokumen Bukti (PDF/JPG/PNG, Max 2MB) <span class="text-danger">*</span></label>
                        <input type="file" name="dokumen_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 "></div>

                    <div class="col-md-6 d-flex justify-content-end">

                        <button type="submit" class="btn btn-sm btn-primary btn-radius px-3 mr-1">Tambah</button>

                        <a href="{{ route('aktivitas.index') }}" class="btn btn-sm bg-dark btn-radius px-4 text-white">Batal</a>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function jalankanPerubahan() {
        var jenis = document.getElementById("jenis_aktivitas").value;
        var kelompokDropdown = document.getElementById("kelompok_aktivitas");
        var formTambahan = document.getElementById("form_tambahan_prestasi");

        // 1. Logika Tampilkan Form Tambahan Prestasi (Disesuaikan dengan value "Kompetisi")
        if (jenis === "Kompetisi") {
            formTambahan.classList.remove("d-none");
        } else {
            formTambahan.classList.add("d-none");
        }

        // 2. Logika Dropdown Kelompok Aktivitas
        kelompokDropdown.innerHTML = "";
        kelompokDropdown.disabled = false;

        if (jenis === "Aktivitas Kemahasiswaan") {
            var opsiAK = [
                "Panitia Kegiatan",
                "Seminar / Workshop / Pelatihan",
                "Aktivitas Pengabdian Masyarakat",
            ];

            var HTMLOpsi = '<option value="" disabled selected>-- Pilih Kelompok Aktivitas Kemahasiswaan --</option>';
            opsiAK.forEach(function(item) {
                HTMLOpsi += '<option value="' + item + '">' + item + '</option>';
            });
            kelompokDropdown.innerHTML = HTMLOpsi;

        } else if (jenis === "Kompetisi") {
            var opsiK = [
                "Kompetisi Tingkat Internasional",
                "Kompetisi Tingkat Nasional",
                "Kompetisi Tingkat Regional / Wilayah",
                "Kompetisi Tingkat Universitas",
                "Kompetisi Tingkat Fakultas / Prodi"
            ];

            var HTMLOpsi = '<option value="" disabled selected>-- Pilih Kelompok Kompetisi --</option>';
            opsiK.forEach(function(item) {
                HTMLOpsi += '<option value="' + item + '">' + item + '</option>';
            });
            kelompokDropdown.innerHTML = HTMLOpsi;

        } else if (jenis === "Program Kreativitas Mahasiswa") {
            var opsiPKM = [
                "Program Kreativitas Mahasiswa (PKM) Nasional - Proposal Didanai",
                "Program Kreativitas Mahasiswa Tingkat Universitas / Fakultas"
            ];

            var HTMLOpsi = '<option value="" disabled selected>-- Pilih Kelompok Program Kreativitas Mahasiswa --</option>';
            opsiPKM.forEach(function(item) {
                HTMLOpsi += '<option value="' + item + '">' + item + '</option>';
            });
            kelompokDropdown.innerHTML = HTMLOpsi;

        } else {
            kelompokDropdown.innerHTML = '<option value="" disabled selected>-- Pilih Jenis Aktivitas Dahulu --</option>';
            kelompokDropdown.disabled = true;
        }
    }
</script>
@endsection