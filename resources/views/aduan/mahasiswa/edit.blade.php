@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">
    <div class="card shadow-sm">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="font-weight-bold text-center m-0">
                EDIT ADUAN
            </h4>
        </div>

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
                        <option value="kemahasiswaan" {{ old('kategori', $aduan->kategori) == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan (Organisasi/Beasiswa/Lomba)</option>
                        <option value="perundungan_dan_etika" {{ old('kategori', $aduan->kategori) == 'perundungan_dan_etika' ? 'selected' : '' }}>Perundungan, Pungli & Etika</option>
                        <option value="akademik" {{ old('kategori', $aduan->kategori) == 'akademik' ? 'selected' : '' }}>Akademik (Perkuliahan/Nilai/Dosen)</option>
                        <option value="fasilitas" {{ old('kategori', $aduan->kategori) == 'fasilitas' ? 'selected' : '' }}>Fasilitas & Sarpras</option>
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

                    <!-- Informasi file yang ada sebelumnya -->
                    @if($aduan->lampiran)
                    <div class="mb-2">
                        <small class="text-muted">Lampiran saat ini: </small>
                        <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-xs btn-outline-info ml-1">
                            👁️ Lihat File Lama
                        </a>
                    </div>
                    @endif

                    <div class="custom-file">
                        <input type="file"
                            name="lampiran"
                            class="custom-file-input @error('lampiran') is-invalid @enderror"
                            id="customFile">
                        <label class="custom-file-label" for="customFile">Pilih file baru jika ingin mengganti...</label>
                    </div>
                    <small class="form-text text-muted">Format: JPG, PNG, PDF (Maks. 2MB). Biarkan kosong jika tidak ingin mengubah file.</small>

                    @error('lampiran')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- 5. Opsi Anonim -->
                <!-- <div class="form-group mt-4 p-3 bg-light rounded border">
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            name="is_anonim"
                            value="1"
                            id="anonimCheck"
                            style="width: 18px; height: 18px; cursor: pointer;"
                            {{ old('is_anonim', $aduan->is_anonim) ? 'checked' : '' }}>
                        <label class="form-check-label font-weight-bold ml-2 pt-1" for="anonimCheck" style="cursor: pointer;">
                            Kirim sebagai Anonim
                        </label>
                    </div>
                </div> -->



                <!-- Button Actions -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm btn-radius mr-1">
                        Simpan
                    </button>
                    <a href="{{ route('aduan.index') }}" class="btn bg-abu-abu  btn-radius btn-sm text-white">
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