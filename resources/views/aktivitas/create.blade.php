@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h4 class="font-weight-bold text-center">TAMBAH DATA AKTIVITAS </h4>
    <div class="card mb-4 ">
        <div class="card-header text-center bg-yellow-4 shadow-sm">
            <strong> Form Pengajuan Aktivitas/Sertifikat</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('aktivitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Periode Akademik <span class="text-danger">*</span></label>
                        <select name="periode_akademik" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Periode --</option>
                            <option value="2025/2026 Ganjil">2025/2026 Genap</option>
                            <option value="2025/2026 Ganjil">2025/2026 Ganjil</option>
                            <option value="2025/2026 Ganjil">2024/2025 Genap</option>
                            <option value="2025/2026 Ganjil">2024/2025 Ganjil</option>
                            <option value="2025/2026 Genap">2023/2024 Genap</option>
                            <option value="2025/2026 Genap">2023/2024 Ganjil</option>
                            <option value="2025/2026 Genap">2022/2023 Genap</option>
                            <option value="2025/2026 Genap">2022/2023 Ganjil</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Aktivitas <span class="text-danger">*</span></label>
                        <select name="jenis_aktivitas" id="jenis_aktivitas" class="form-control" required onchange="jalankanPerubahan()">
                            <option value="" disabled selected>-- Pilih Jenis Aktivitas --</option>
                            <option value="Aktivitas Kemahasiswaan">AK (Aktivitas Kemahasiswaan)</option>
                            <option value="Kompetisi">K (Kompetisi / Prestasi)</option>
                            <option value="Program Kreativitas Mahasiswa">PKM (Program Kreativitas Mahasiswa)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kelompok Aktivitas <span class="text-danger">*</span></label>
                        <select name="kelompok_aktivitas" id="kelompok_aktivitas" class="form-control" required disabled>
                            <option value="" disabled selected>-- Pilih Jenis Aktivitas Dahulu --</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Aktivitas / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aktivitas" class="form-control" placeholder="Contoh: Seminar Nasional Teknologi Informasi" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">
                            Jenis Kegiatan <span class="text-danger">*</span>
                        </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kegiatan"
                                id="akademik" value="Akademik" required>
                            <label class="form-check-label" for="akademik">
                                Akademik
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kegiatan"
                                id="non_akademik" value="Non Akademik" required>
                            <label class="form-check-label" for="non_akademik">
                                Non Akademik
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row d-none" id="form_tambahan_prestasi">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Prestasi <span class="text-danger">*</span></label>
                        <select name="jenis_prestasi" class="form-control">
                            <option value="Lain-lain" selected>-- Pilih Jenis Prestasi --</option>
                            <option value="Sains">Sains</option>
                            <option value="Seni">Seni</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Peringkat</label>
                        <select name="jenis_prestasi" class="form-control">
                            <option value="" selected>-- Pilih Peringkat --</option>
                            <option value="Juara 1">Juara 1</option>
                            <option value="Juara 2">Juara 2</option>
                            <option value="Juara 3">Juara 3</option>
                            <option value="Medali Emas">Medali Emas</option>
                            <option value="Medali Perak">Medali Perak</option>
                            <option value="Medali Perunggu">Medali Perunggu</option>
                            <option value="Peserta/Delegasi">Peserta/Delegasi</option>
                            <option value="Juara Harapan 1">Juara Harapan 1</option>
                            <option value="Juara Harapan 2">Juara Harapan 2</option>
                            <option value="Juara Harapan 3">Juara Harapan 3</option>
                            <option value="Best Performance">Best Performance</option>
                            <option value="Peserta Favorit">Peserta Favorit</option>
                            <option value="Apresiasi Kejuaraan">Apresiasi Kejuaraan</option>
                            <option value="Juara Umum">Juara Umum</option>
                            <option value="Penghargaan Tambahan">Penghargaan Tambahan</option>
                            <option value="Peserta">Peserta</option>
                            <option value="Best Speaker">Best Speaker</option>
                            <option value="Honorable Mention (MW)/Juara Harapan">Honorable Mention (MW)/Juara Harapan</option>
                            <option value="Peserta Nasional">Peserta Nasional</option>
                            <option value="Peserta Wilayah">Peserta Wilayah</option>
                            <option value="Pembicara Terbaik">Pembicara Terbaik</option>
                            <option value="Predikat Khusus">Predikat Khusus</option>
                            <option value="Juara Favorit">Juara Favorit</option>
                            <option value="Finalis">Finalis</option>
                            <option value="Proposal Didanai">Proposal Didanai</option>
                            <option value="PKM Award">PKM Award</option>
                            <option value="Juara I Presentasi">Juara I Presentasi</option>
                            <option value="Juara II Presentasi">Juara II Presentasi</option>
                            <option value="Juara III Presentasi">Juara III Presentasi</option>
                            <option value="Juara I Poster">Juara I Poster</option>
                            <option value="Juara II Poster">Juara II Poster</option>
                            <option value="Juara III Poster">Juara III Poster</option>
                            <option value="Terbaik I">Terbaik I</option>
                            <option value="Terbaik II">Terbaik II</option>
                            <option value="Terbaik III">Terbaik III</option>
                            <option value="Terbaik Harapan">Terbaik Harapan</option>
                            <option value="EFL Champion">EFL Champion</option>
                            <option value="Delegasi">Delegasi</option>
                            <option value="ESL Champion">ESL Champion</option>
                            <option value="Sertifikat">Sertifikat</option>
                            <option value="Kontingen">Kontingen</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tingkat Prestasi / Aktivitas <span class="text-danger">*</span></label>
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

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jabatan / Peran</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Ketua / Anggota / Peserta">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" placeholder="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Dokumen Pendukung <span class="text-danger">*</span></label>
                        <select name="jenis_dokumen_pendukung" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Jenis Dokumen --</option>
                            <option value="Dokumentasi/ Foto Kegiatan">Dokumentasi/ Foto Kegiatan</option>
                            <option value="SK Kegiatan/ Surat Tugas">SK Kegiatan/ Surat Tugas</option>
                            <option value="Sertifikat Kegiatan">Sertifikat Kegiatan</option>
                            <option value="Undangan Kegiatan (Finalis)">Undangan Kegiatan (Finalis)</option>
                            >
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Upload Dokumen Bukti (PDF/JPG/PNG, Max 2MB) <span class="text-danger">*</span></label>
                        <input type="file" name="dokumen_pendukung" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div></div>
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

        // 1. Logika Tampilkan / Sembunyikan Form Tambahan Prestasi (Khusus K)
        if (jenis === "K") {
            formTambahan.classList.remove("d-none");
        } else {
            formTambahan.classList.add("d-none");
        }

        // 2. Logika Mengubah Isi Pilihan Dropdown Kelompok Aktivitas Berdasarkan Jenis
        kelompokDropdown.innerHTML = ""; // Bersihkan opsi lama
        kelompokDropdown.disabled = false; // Aktifkan dropdown

        if (jenis === "Aktivitas Kemahasiswaan") {
            // Jika memilih Aktivitas Kemahasiswaan (AK)
            var opsiAK = [
                "Panitia Kegiatan",
                "Seminar / Workshop / Pelatihan",
                "Organisasi Mahasiswa (Pengurus)",
                "Aktivitas Pengabdian Masyarakat",
            ];

            var HTMLOpsi = '<option value="" disabled selected>-- Pilih Kelompok Aktivitas Kemahasiswaan --</option>';
            opsiAK.forEach(function(item) {
                HTMLOpsi += '<option value="' + item + '">' + item + '</option>';
            });
            kelompokDropdown.innerHTML = HTMLOpsi;

        } else if (jenis === "Kompetisi") {
            // Jika memilih Kompetisi / Prestasi (K)
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
            // Jika memilih Program Kreativitas Mahasiswa (PKM)
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