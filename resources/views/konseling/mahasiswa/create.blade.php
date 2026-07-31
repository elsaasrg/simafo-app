@extends('layouts.app')

@section('content')

<div class="container">
    <h4 class="text-center mb-3"><strong>TAMBAH KONSELING</strong></h4>
    <div class="card">
        <div class="card-body">

            <form action="{{ route('konseling.store') }}"
                method="POST">

                @csrf

                <div class="mb-3">
                    <label>Kepada:</label>
                    <select name="dosen_id" class="form-control" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                        @endforeach
                    </select>
                </div>
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
                    <label class="form-label">Isi Konseling</label>

                    <textarea
                        name="isi_konseling"
                        rows="5"
                        class="form-control @error('isi_konseling') is-invalid @enderror">{{ old('isi_konseling') }}</textarea>

                    @error('isi_konseling')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary btn-sm btn-radius px-3 mr-1">
                        Kirim
                    </button>
                    <a href="{{ route('konseling.index') }}" class="btn btn-sm btn-dark text-white btn-radius">Batal</a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection