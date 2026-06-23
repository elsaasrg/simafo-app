@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="float-start">Edit Konseling</div>
                    <div class="float-end"> <a href="{{ route('konseling.index') }}" class="btn btn-primary">&larr; Back</a></div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('konseling.update', $konseling->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Kepada:</label>
                        <select name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($listDosen as $dosen)
                            <option value="{{ $dosen->id }}" {{ ($dosen->id == $konseling->dosen_id) ? 'selected' : ''  }}>{{ $dosen->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subjek</label>

                        <input type="text"
                            name="subjek"
                            class="form-control @error('subjek') is-invalid @enderror"
                            value="{{ $konseling->subjek }}">

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
                            class="form-control @error('isi_konseling') is-invalid @enderror">{{ $konseling->isi_konseling }}</textarea>

                        @error('isi_konseling')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Kirim Konseling
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection