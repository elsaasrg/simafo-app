@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">
    <div class="card shadow-sm">

        <div class="card-header py-3">
            <h4 class="font-weight-bold text-center">
                TAMBAH ADUAN
            </h4>
        </div>

        <div class="card-body">

            <!-- Wajib menggunakan enctype untuk upload file -->
            <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- 1. Kategori Aduan -->
                <div class="form-group">
                    <label class="font-weight-bold">Kategori Aduan <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <option value="kemahasiswaan" {{ old('kategori') == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                        <option value="perundungan_dan_etika" {{ old('kategori') == 'perundungan_dan_etika' ? 'selected' : '' }}>Perundungan, Pungli & Etika</option>
                        <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="fasilitas" {{ old('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="layanan_administrasi" {{ old('kategori') == 'layanan_administrasi' ? 'selected' : '' }}>Layanan Administrasi / Staf</option>
                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                        value="{{ old('subjek') }}"
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
                        placeholder="Jelaskan detail aduan Anda...">{{ old('isi_aduan') }}</textarea>

                    @error('isi_aduan')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 4. Upload Lampiran / Bukti -->
                <div class="form-group">
                    <label class="font-weight-bold">Lampiran Bukti (Opsional)</label>
                    <div class="custom-file">
                        <input type="file"
                            name="lampiran"
                            class="custom-file-input @error('lampiran') is-invalid @enderror"
                            id="customFile">
                        <label class="custom-file-label" for="customFile">Pilih file...</label>
                    </div>
                    <small class="form-text text-muted">Format: JPG, PNG, PDF (Maks. 2MB)</small>

                    @error('lampiran')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 5. Opsi Anonim (Fix Checkbox) -->
                <!-- <div class="form-group mt-4 p-3 bg-light rounded border">
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            name="is_anonim"
                            value="1"
                            id="anonimCheck"
                            style="width: 18px; height: 18px; cursor: pointer;"
                            {{ old('is_anonim') ? 'checked' : '' }}>
                        <label class="form-check-label font-weight-bold ml-2 pt-1" for="anonimCheck" style="cursor: pointer;">
                            Kirim sebagai Anonim
                        </label>
                    </div>

                </div> -->

                <hr>

                <!-- Button Actions -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('aduan.index') }}" class="btn btn-sm btn-primary px-2 btn-radius mr-1">
                        Tambah
                    </a>
                    <button type="submit" class="btn btn-sm bg-abu-abu btn-radius px-2 text-white">
                        Batal
                    </button>
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