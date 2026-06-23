@extends('layouts.app')

@section('content')


{{ $errors }}
<div class="container">
    <div class="card">

        <div class="card-header">
            Tambah aduan
        </div>

        <div class="card-body">

            <form action="{{ route('aduan.store') }}"
                method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Subjek</label>

                    <input type="text"
                        name="subjek"
                        class="form-control @error('subjek') is-invalid @enderror"
                        value="{{ old('subjek') }}">

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
                        class="form-control @error('isi_aduan') is-invalid @enderror">{{ old('isi_aduan') }}</textarea>

                    @error('isi_aduan')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Kirim Aduan
                </button>
            </form>

        </div>
    </div>
</div>

@endsection