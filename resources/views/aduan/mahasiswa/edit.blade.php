@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">
    <h4 class="font-weight-bold text-center mb-3">
        EDIT ADUAN
    </h4>
    <div class="card shadow-sm">


        <div class="card-body">

            <!-- Wajib menggunakan enctype untuk upload file lampiran -->
            <form action="{{ route('aduan.update', $aduan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- 1. Kategori Aduan -->
                <div class="form-group">
                    <label class="font-weight-bold">Kategori Aduan <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                        <option value="" disabled>-- Pilih Kategori --</option>
                        <option value="kemahasiswaan" {{ old('kategori', $aduan->kategori) == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan </option>
                        <option value="perundungan_dan_etika" {{ old('kategori', $aduan->kategori) == 'perundungan_dan_etika' ? 'selected' : '' }}>Perundungan, Pungli, dan Etika</option>
                        <option value="akademik" {{ old('kategori', $aduan->kategori) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="fasilitas" {{ old('kategori', $aduan->kategori) == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="layanan_administrasi" {{ old('kategori', $aduan->kategori) == 'layanan_administrasi' ? 'selected' : '' }}>Layanan Administrasi / Staf</option>
                        <option value="lainnya" {{ old('kategori', $aduan->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>

                    @error('kategori')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 2. Subjek -->
                <div class="form-group">
                    <label class="font-weight-bold">Subjek <span class="text-danger">*</span></label>
                    <input type="text"
                        name="subjek"
                        class="form-control @error('subjek') is-invalid @enderror"
                        value="{{ old('subjek', $aduan->subjek) }}"
                        placeholder="Ringkasan singkat masalah">

                    @error('subjek')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 3. Isi Aduan -->
                <div class="form-group">
                    <label class="font-weight-bold">Isi Aduan <span class="text-danger">*</span></label>
                    <textarea
                        name="isi_aduan"
                        rows="5"
                        class="form-control @error('isi_aduan') is-invalid @enderror"
                        placeholder="Jelaskan detail aduan Anda...">{{ old('isi_aduan', $aduan->isi_aduan) }}</textarea>

                    @error('isi_aduan')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 4. Upload Lampiran / Bukti -->
                <div class="form-group">
                    <label class="font-weight-bold">Lampiran Bukti (Opsional)</label>



                    <div class="custom-file mb-1">
                        <input type="file"
                            name="lampiran"
                            class="custom-file-input @error('lampiran') is-invalid @enderror"
                            id="customFile">
                        <label class="custom-file-label" for="customFile">Pilih file baru jika ingin mengganti...</label>
                    </div>
                    <small class="form-text text-muted mb-2">Format: JPG, PNG, PDF (Maks. 2MB). Biarkan kosong jika tidak ingin mengubah file.</small>

                    @if($aduan->lampiran)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-info ml-1">
                            <i class="fas fa-file-alt mr-1"></i><span class="text-dark"> Buka File Saat Ini</span>
                        </a>
                    </div>
                    @endif
                    @error('lampiran')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Button Actions -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm btn-radius mr-1">
                        Simpan
                    </button>
                    <a href="{{ route('aduan.index') }}" class="btn bg-dark btn-radius btn-sm text-white px-2">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('js')
<!-- Script agar nama file yang dipilih muncul di input file Bootstrap 4 -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush