@extends('layouts.app')

@section('content')

{{ $errors }}
<div class="container">
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Edit Aduan</span>
            <a href="{{ route('aduan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <div class="card-body">

            <form action="{{ route('aduan.update', $aduan->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Subjek</label>

                    <input type="text"
                        name="subjek"
                        class="form-control @error('subjek') is-invalid @enderror"
                        value="{{ old('subjek', $aduan->subjek) }}">

                    @error('subjek')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Isi aduan</label>

                    <textarea
                        name="isi_aduan"
                        rows="5"
                        class="form-control @error('isi_aduan') is-invalid @enderror">{{ old('isi_aduan', $aduan->isi_aduan) }}</textarea>

                    @error('isi_aduan')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </form>

        </div>
    </div>
</div>

@endsection