@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <h4 class="text-center font-weight-bold">EDIT DATA AKTIVITAS</h4>

        <div class="col-md-11">

            <div class="card shadow-sm">

                <div class="card-header text-center bg-yellow-4 text-dark py-3">

                    <h6 class="m-0"><strong><i class="fas fa-edit mr-1"></i>Form Edit Data Aktivitas</strong></h6>

                </div>
                <div class="card-body p-4">
                    <form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- BARIS 1: Periode & Jenis Aktivitas -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Periode Akademik <span class="text-danger">*</span></label>
                                <select name="periode_akademik" class="form-control" required>
                                    <option value="" disabled>-- Pilih Periode --</option>
                                    @php
                                    $periodeOld = old('periode_akademik', $aktivitas->periode_akademik);
                                    @endphp
                                    <option value="2025/2026 Genap" {{ $periodeOld == '2025/2026 Genap' ? 'selected' : '' }}>2025/2026 Genap</option>
                                    <option value="2025/2026 Ganjil" {{ $periodeOld == '2025/2026 Ganjil' ? 'selected' : '' }}>2025/2026 Ganjil</option>
                                    <option value="2024/2025 Genap" {{ $periodeOld == '2024/2025 Genap' ? 'selected' : '' }}>2024/2025 Genap</option>
                                    <option value="2024/2025 Ganjil" {{ $periodeOld == '2024/2025 Ganjil' ? 'selected' : '' }}>2024/2025 Ganjil</option>
                                    <option value="2023/2024 Genap" {{ $periodeOld == '2023/2024 Genap' ? 'selected' : '' }}>2023/2024 Genap</option>
                                    <option value="2023/2024 Ganjil" {{ $periodeOld == '2023/2024 Ganjil' ? 'selected' : '' }}>2023/2024 Ganjil</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jenis Aktivitas <span class="text-danger">*</span></label>
                                <select name="jenis_aktivitas" id="jenis_aktivitas" class="form-control" required onchange="jalankanPerubahan()">
                                    <option value="" disabled>-- Pilih Jenis Aktivitas --</option>
                                    @php
                                    $jenisOld = old('jenis_aktivitas', $aktivitas->jenis_aktivitas);
                                    @endphp
                                    <option value="Aktivitas Kemahasiswaan" {{ $jenisOld == 'Aktivitas Kemahasiswaan' ? 'selected' : '' }}>AK (Aktivitas Kemahasiswaan)</option>
                                    <option value="Kompetisi" {{ $jenisOld == 'Kompetisi' ? 'selected' : '' }}>K (Kompetisi / Prestasi)</option>
                                    <option value="Program Kreativitas Mahasiswa" {{ $jenisOld == 'Program Kreativitas Mahasiswa' ? 'selected' : '' }}>PKM (Program Kreativitas Mahasiswa)</option>
                                </select>
                            </div>
                        </div>

                        <!-- BARIS 2: Kelompok Aktivitas & Nama Aktivitas -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Kelompok Aktivitas <span class="text-danger">*</span></label>
                                <select name="kelompok_aktivitas" id="kelompok_aktivitas" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Jenis Aktivitas Dahulu --</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Nama Aktivitas / Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_aktivitas" class="form-control" value="{{ old('nama_aktivitas', $aktivitas->nama_aktivitas) }}" placeholder="Contoh: Seminar Nasional Teknologi Informasi" required>
                            </div>
                        </div>

                        <!-- BARIS 3: Jenis Kegiatan (Radio) -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label font-weight-bold d-block">Jenis Kegiatan <span class="text-danger">*</span></label>
                                @php
                                $kegiatanOld = old('jenis_kegiatan', $aktivitas->jenis_kegiatan);
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kegiatan" id="akademik" value="Akademik" {{ $kegiatanOld == 'Akademik' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="akademik">Akademik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kegiatan" id="non_akademik" value="Non Akademik" {{ $kegiatanOld == 'Non Akademik' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="non_akademik">Non Akademik</label>
                                </div>
                            </div>
                        </div>

                        <!-- FORM TAMBAHAN KHUSUS KOMPETISI (Dinamis via JS) -->
                        <div class="row d-none" id="form_tambahan_prestasi">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jenis Prestasi</label>
                                @php $prestasiOld = old('jenis_prestasi', $aktivitas->jenis_prestasi); @endphp
                                <select name="jenis_prestasi" class="form-control">
                                    <option value="">-- Pilih Jenis Prestasi --</option>
                                    <option value="Sains" {{ $prestasiOld == 'Sains' ? 'selected' : '' }}>Sains</option>
                                    <option value="Seni" {{ $prestasiOld == 'Seni' ? 'selected' : '' }}>Seni</option>
                                    <option value="Olahraga" {{ $prestasiOld == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                    <option value="Lain-lain" {{ $prestasiOld == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Peringkat / Juara</label>
                                @php $peringkatOld = old('peringkat', $aktivitas->peringkat); @endphp
                                <select name="peringkat" class="form-control">
                                    <option value="">-- Pilih Peringkat --</option>
                                    <option value="Juara 1" {{ $peringkatOld == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                                    <option value="Juara 2" {{ $peringkatOld == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                                    <option value="Juara 3" {{ $peringkatOld == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                                    <option value="Medali Emas" {{ $peringkatOld == 'Medali Emas' ? 'selected' : '' }}>Medali Emas</option>
                                    <option value="Medali Perak" {{ $peringkatOld == 'Medali Perak' ? 'selected' : '' }}>Medali Perak</option>
                                    <option value="Medali Perunggu" {{ $peringkatOld == 'Medali Perunggu' ? 'selected' : '' }}>Medali Perunggu</option>
                                    <option value="Juara Harapan 1" {{ $peringkatOld == 'Juara Harapan 1' ? 'selected' : '' }}>Juara Harapan 1</option>
                                    <option value="Juara Harapan 2" {{ $peringkatOld == 'Juara Harapan 2' ? 'selected' : '' }}>Juara Harapan 2</option>
                                    <option value="Juara Harapan 3" {{ $peringkatOld == 'Juara Harapan 3' ? 'selected' : '' }}>Juara Harapan 3</option>
                                    <option value="Best Performance" {{ $peringkatOld == 'Best Performance' ? 'selected' : '' }}>Best Performance</option>
                                    <option value="Peserta/Delegasi" {{ $peringkatOld == 'Peserta/Delegasi' ? 'selected' : '' }}>Peserta/Delegasi</option>
                                    <option value="Finalis" {{ $peringkatOld == 'Finalis' ? 'selected' : '' }}>Finalis</option>
                                </select>
                            </div>
                        </div>

                        <!-- BARIS 4: Tingkat, Jabatan, Penyelenggara, Lokasi -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">Tingkat Prestasi / Aktivitas <span class="text-danger">*</span></label>
                                @php $tingkatOld = old('tingkat_prestasi', $aktivitas->tingkat_prestasi); @endphp
                                <select name="tingkat_prestasi" class="form-control" required>
                                    <option value="" disabled>-- Pilih Tingkat --</option>
                                    <option value="Sekolah" {{ $tingkatOld == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="Kecamatan" {{ $tingkatOld == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="Kabupaten/Kota" {{ $tingkatOld == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                    <option value="Provinsi" {{ $tingkatOld == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ $tingkatOld == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ $tingkatOld == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    <option value="Regional" {{ $tingkatOld == 'Regional' ? 'selected' : '' }}>Regional</option>
                                    <option value="Lainnya" {{ $tingkatOld == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">Jabatan / Peran</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $aktivitas->jabatan) }}" placeholder="Contoh: Ketua / Anggota">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">Penyelenggara</label>
                                <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara', $aktivitas->penyelenggara) }}" placeholder="Contoh: Universitas Tanjungpura">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">Lokasi Aktivitas</label>
                                <input type="text" name="lokasi_aktivitas" class="form-control" value="{{ old('lokasi_aktivitas', $aktivitas->lokasi_aktivitas) }}" placeholder="Contoh: Online / Pontianak">
                            </div>
                        </div>

                        <!-- BARIS 5: Tanggal Mulai & Tanggal Selesai -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_mulai" class="form-control"
                                    value="{{ old('tanggal_mulai', $aktivitas->tanggal_mulai ? date('Y-m-d', strtotime($aktivitas->tanggal_mulai)) : '') }}" required>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_selesai" class="form-control"
                                    value="{{ old('tanggal_selesai', $aktivitas->tanggal_selesai ? date('Y-m-d', strtotime($aktivitas->tanggal_selesai)) : '') }}" required>
                            </div>
                        </div>

                        <!-- BARIS 6: Dokumen Pendukung -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jenis Dokumen Pendukung <span class="text-danger">*</span></label>
                                @php $docTypeOld = old('jenis_dokumen_pendukung', $aktivitas->jenis_dokumen_pendukung); @endphp
                                <select name="jenis_dokumen_pendukung" class="form-control" required>
                                    <option value="" disabled>-- Pilih Jenis Dokumen --</option>
                                    <option value="Dokumentasi/ Foto Kegiatan" {{ $docTypeOld == 'Dokumentasi/ Foto Kegiatan' ? 'selected' : '' }}>Dokumentasi/ Foto Kegiatan</option>
                                    <option value="SK Kegiatan/ Surat Tugas" {{ $docTypeOld == 'SK Kegiatan/ Surat Tugas' ? 'selected' : '' }}>SK Kegiatan/ Surat Tugas</option>
                                    <option value="Sertifikat Kegiatan" {{ $docTypeOld == 'Sertifikat Kegiatan' ? 'selected' : '' }}>Sertifikat Kegiatan</option>
                                    <option value="Undangan Kegiatan (Finalis)" {{ $docTypeOld == 'Undangan Kegiatan (Finalis)' ? 'selected' : '' }}>Undangan Kegiatan (Finalis)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">
                                    Upload Dokumen Bukti
                                    <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                                </label>
                                <input type="file" name="dokumen_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png">

                                @if($aktivitas->dokumen_pendukung)
                                <div class="mt-2">
                                    <a href="{{ asset('uploads/dokumen_aktivitas/' . $aktivitas->dokumen_pendukung) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-file-alt mr-1"></i> Lihat Dokumen Saat Ini
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-right">

                            <button type="submit" class="btn btn-primary btn-sm btn-radius px-2">

                                Simpan

                            </button>

                            <a href="{{ route('aktivitas.index') }}" class="btn btn-sm px-2 btn-radius bg-dark px-3 text-white">

                                Batal

                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Variabel simpan nilai awal/database untuk kelompok_aktivitas
            var selectedKelompokOld = "{{ old('kelompok_aktivitas', $aktivitas->kelompok_aktivitas) }}";

            function jalankanPerubahan() {
                var jenis = document.getElementById("jenis_aktivitas").value;
                var kelompokDropdown = document.getElementById("kelompok_aktivitas");
                var formTambahan = document.getElementById("form_tambahan_prestasi");

                // 1. Tampilkan/Sembunyikan Form Tambahan Prestasi
                if (jenis === "Kompetisi") {
                    formTambahan.classList.remove("d-none");
                } else {
                    formTambahan.classList.add("d-none");
                }

                // 2. Isi Dropdown Kelompok Aktivitas
                kelompokDropdown.innerHTML = "";
                kelompokDropdown.disabled = false;

                var opsiData = [];
                var defaultText = "";

                if (jenis === "Aktivitas Kemahasiswaan") {
                    opsiData = [
                        "Panitia Kegiatan",
                        "Seminar / Workshop / Pelatihan",
                        "Aktivitas Pengabdian Masyarakat"
                    ];
                    defaultText = "-- Pilih Kelompok Aktivitas Kemahasiswaan --";
                } else if (jenis === "Kompetisi") {
                    opsiData = [
                        "Kompetisi Tingkat Internasional",
                        "Kompetisi Tingkat Nasional",
                        "Kompetisi Tingkat Regional / Wilayah",
                        "Kompetisi Tingkat Universitas",
                        "Kompetisi Tingkat Fakultas / Prodi"
                    ];
                    defaultText = "-- Pilih Kelompok Kompetisi --";
                } else if (jenis === "Program Kreativitas Mahasiswa") {
                    opsiData = [
                        "Program Kreativitas Mahasiswa (PKM) Nasional - Proposal Didanai",
                        "Program Kreativitas Mahasiswa Tingkat Universitas / Fakultas"
                    ];
                    defaultText = "-- Pilih Kelompok Program Kreativitas Mahasiswa --";
                }

                if (opsiData.length > 0) {
                    var HTMLOpsi = '<option value="" disabled>' + defaultText + '</option>';
                    opsiData.forEach(function(item) {
                        var isSelected = (item === selectedKelompokOld) ? 'selected' : '';
                        HTMLOpsi += '<option value="' + item + '" ' + isSelected + '>' + item + '</option>';
                    });
                    kelompokDropdown.innerHTML = HTMLOpsi;
                } else {
                    kelompokDropdown.innerHTML = '<option value="" disabled selected>-- Pilih Jenis Aktivitas Dahulu --</option>';
                    kelompokDropdown.disabled = true;
                }
            }

            // Jalankan fungsi saat pertama kali halaman Edit selesai di-load
            window.addEventListener('DOMContentLoaded', function() {
                jalankanPerubahan();
            });
        </script>
        @endsection