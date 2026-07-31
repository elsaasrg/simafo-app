@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4 font-weight-bold text-dark text-center mb-3">TAMBAH TRACER STUDY</h4>


    {{-- Alert Validation Error Global --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- 1. BAGIAN ATAS: BIODATA ALUMNI --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-yellow-4 text-dark py-3 font-weight-bold text-center">
            <i class="fas fa-id-card mr-1"></i> Biodata Alumni
        </div>
        <div class="card-body p-4">
            <div class="row text-center text-md-left">
                <div class="col-md-4 mb-3 mb-md-0 border-end-md">
                    <small class="d-block font-weight-bold text-uppercase">Nama</small>
                    <span class="h6 text-muted  mb-0">{{ $mahasiswa->user->name }}</span>
                </div>
                <div class="col-md-4 mb-3 mb-md-0 border-end-md">
                    <small class="d-block font-weight-bold text-uppercase">Nomor Induk Mahasiswa (NIM)</small>
                    <span class="h6 text-muted  mb-0">{{ $mahasiswa->nim }}</span>
                </div>
                <div class="col-md-4">
                    <small class=" d-block font-weight-bold text-uppercase">Tahun Kelulusan</small>
                    <span class="h6 text-muted mb-0">
                        <i class="fas fa-graduation-cap mr-1"></i> Lulus Tahun {{ $mahasiswa->tahun_lulus }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. BAGIAN BAWAH: FORM KUESIONER TRACER STUDY --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-yellow-4 py-3 font-weight-bold text-center">
            <i class="fas fa-poll-h mr-1"></i> Pengisian Kuesioner Pelacakan Alumni
        </div>

        <div class="card-body p-4">
            <form action="{{ route('tracer-study.store', $mahasiswa->id) }}" method="POST">
                @csrf

                {{-- Pertanyaan Utama: Status --}}
                <div class="mb-4">
                    <label for="status_saat_ini" class="form-label font-weight-bold">1. Apa status kegiatan utama Anda saat ini? <span class="text-danger">*</span></label>
                    <select name="status_saat_ini" id="status_saat_ini" class="form-control @error('status_saat_ini') is-invalid @enderror">
                        <option value="" disabled {{ old('status_saat_ini') == '' ? 'selected' : '' }}>-- Pilih Status Saat Ini --</option>
                        <option value="bekerja" {{ old('status_saat_ini') == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                        <option value="wirausaha" {{ old('status_saat_ini') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                        <option value="studi_lanjut" {{ old('status_saat_ini') == 'studi_lanjut' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
                        <option value="mencari_kerja" {{ old('status_saat_ini') == 'mencari_kerja' ? 'selected' : '' }}>Mencari Kerja / Belum Bekerja</option>
                    </select>
                    @error('status_saat_ini')
                    <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- CONTAINER GRUP A: RIWAYAT PEKERJAAN / WIRAUSAHA --}}
                <div class="card p-3 border-0 bg-light mb-4">
                    <div class="p-2 mb-3 bg-white rounded font-weight-bold text-success small shadow-sm">
                        <i class="fas fa-briefcase mr-1"></i> KUESIONER RIWAYAT PEKERJAAN / WIRAUSAHA <span class="text-muted font-weight-normal">(Wajib diisi jika Anda bekerja/wirausaha)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">2. Berapa lama waktu yang Anda butuhkan untuk mendapatkan pekerjaan pertama setelah lulus?</label>
                        <select name="masa_tunggu" class="form-control">
                            <option value="" selected disabled>-- Pilih Masa Tunggu --</option>
                            <option value="kurang dari 3 bulan" {{ old('masa_tunggu') == 'kurang dari 3 bulan' ? 'selected' : '' }}>Kurang dari 3 bulan</option>
                            <option value="3-6 bulan" {{ old('masa_tunggu') == '3-6 bulan' ? 'selected' : '' }}>3-6 bulan</option>
                            <option value="6-12 bulan" {{ old('masa_tunggu') == '6-12 bulan' ? 'selected' : '' }}>6-12 bulan</option>
                            <option value="1-2 tahun" {{ old('masa_tunggu') == '1-2 tahun' ? 'selected' : '' }}>1-2 tahun</option>
                            <option value="lebih dari 2 tahun" {{ old('masa_tunggu') == 'lebih dari 2 tahun' ? 'selected' : '' }}>Lebih dari 2 tahun</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">3. Apa pekerjaan atau jabatan Anda saat ini?</label>
                        <input type="text" name="nama_pekerjaan" class="form-control" value="{{ old('nama_pekerjaan') }}" placeholder="Contoh: IT Support / Manajer Pemasaran">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">4. Dimana lokasi perusahaan tempat Anda bekerja?</label>
                        <input type="text" name="lokasi_kerja" class="form-control" value="{{ old('lokasi_kerja') }}" placeholder="Contoh: Jakarta Selatan / Remote">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">5. Berapa rata-rata gaji bersih Anda dalam sebulan?</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white font-weight-bold">Rp</span>
                            </div>
                            <input type="number" name="gaji" class="form-control" value="{{ old('gaji') }}" placeholder="Contoh: 4500000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">6. Skala 1-5, seberapa sesuaikah bidang kerja dengan jurusan kuliah Anda?</label>
                        <input type="number" name="tingkat_kesesuaian" min="1" max="5" class="form-control" value="{{ old('tingkat_kesesuaian') }}" placeholder="Masukkan angka skala 1 s.d 5">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">7. Saat ini Anda bekerja di sektor apa? </label>
                        <select name="sektor_kerja" class="form-control">
                            <option value="" selected disabled>-- Pilih Sektor Kerja --</option>
                            <option value="instansi_pemerintah" {{ old('sektor_kerja') == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                            <option value="bumn_bumd" {{ old('sektor_kerja') == 'bumn_bumd' ? 'selected' : '' }}>BUMN/BUMD</option>
                            <option value="swasta" {{ old('sektor_kerja') == 'swasta' ? 'selected' : '' }}>Swasta</option>
                            <option value="organisasi_multilateral" {{ old('sektor_kerja') == 'organisasi_multilateral' ? 'selected' : '' }}>Organisasi Multilateral</option>
                            <option value="wirausaha" {{ old('sektor_usaha') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                            <option value="lainnya" {{ old('sektor_usaha') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">8. Bagaimana Anda mendapatkan informasi mengenai lowongan pekerjaan Anda?</label>
                        <input type="text" name="metode_cari_kerja" class="form-control" value="{{ old('metode_cari_kerja') }}" placeholder="Contoh: media">
                    </div>
                </div>

                {{-- CONTAINER GRUP B: MELANJUTKAN PENDIDIKAN --}}
                <div class="card p-3 border-0 bg-light mb-4">
                    <div class="p-2 mb-3 bg-white rounded font-weight-bold text-info small shadow-sm">
                        <i class="fas fa-university mr-1"></i> KUESIONER PENDIDIKAN LANJUT (S2/S3) <span class="text-muted font-weight-normal">(Wajib diisi jika Anda melanjutkan studi)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">9. Nama Program Studi Pendidikan Lanjut Anda:</label>
                        <input type="text" name="program_studi_lanjut" class="form-control" value="{{ old('program_studi_lanjut') }}" placeholder="Contoh: Magister Sistem Informasi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">10. Nama Universitas / Institusi Tempat Studi Lanjut:</label>
                        <input type="text" name="institusi_studi_lanjut" class="form-control" value="{{ old('institusi_studi_lanjut') }}" placeholder="Contoh: Universitas Gadjah Mada">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">11. Apa sumber dana utama yang membiayai studi lanjutan Anda?</label>
                        <select name="sektor_kerja" class="form-control">
                            <option value="" selected disabled>-- Pilih Sumber Dana Studi --</option>
                            <option value="beasiswa" {{ old('sumber_dana_studi') == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                            <option value="biaya_sendiri" {{ old('sumber_dana_studi') == 'biaya_sendiri' ? 'selected' : '' }}>Biaya Sendiri</option>
                        </select>
                    </div>
                </div>






                {{-- CONTAINER GRUP B: LAINNYA --}}
                <div class="card p-3 border-0 bg-light mb-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">9. Apa saran atau masukan yang dapat Anda berikan untuk pengembangan dan perbaikan program studi?</label>
                        <textarea name="saran_perbaikan" id="form-control" class="form-control" rows="4" placeholder="Berikan pendapat Anda.."></textarea>
                    </div>
                </div>

                <hr class="mt-4 mb-4">

                {{-- Tombol Kontrol Aksi --}}
                <div class="d-flex justify-content-start mb-2">
                    <button type="submit" class="btn btn-sm btn-primary  font-weight-bold mr-2 shadow-sm btn-radius">
                        <i class="fas fa-paper-plane mr-1 text-dark"></i> Kirim Kuesioner
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-radius bg-grey-2 px-3 shadow-sm text-white">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #dee2e6 !important;
        }
    }
</style>
@endsection