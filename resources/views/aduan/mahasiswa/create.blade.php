@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">
    <h4 class="font-weight-bold text-center mb-3">
        TAMBAH ADUAN
    </h4>
    <div class="card shadow-sm">
        <div class="card-body">


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
                    <div>
                        <input type="file"
                            name="lampiran"
                            class="form-control @error('lampiran') is-invalid @enderror"
                            id="customFile">
                    </div>
                    <small class="form-text text-muted">Format: JPG, PNG, PDF (Maks. 2MB)</small>

                    @error('lampiran')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <!-- Button Actions -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary btn-radius px-2 text-white mr-2">
                        Tambah
                    </button>
                    <a href="{{ route('aduan.index') }}" class="btn btn-sm bg-dark px-2 btn-radius ">
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