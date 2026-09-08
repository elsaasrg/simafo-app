@extends('layouts.app')

@section('content')

<div class="container-fluid pt-3">

    {{-- Flash Message Success --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- Flash Message Error --}}
    @if(session('error') || $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') ?? 'Terdapat kesalahan pada pengisian form di bawah ini.' }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h4 class="font-weight-bold  m-0">
                DETAIL ADUAN
            </h4>
        </div>

        <div class="card-body">

            <!-- Information Table -->
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th style="width: 22%;">Pelapor</th>
                        <td>
                            {{ $aduan->mahasiswa->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 22%;">NIM Pelapor</th>
                        <td>
                            <span class="mr-2">
                                {{ $aduan->mahasiswa->nim ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>

                            {{ ucfirst(str_replace('_', ' ', $aduan->kategori ?? 'Lainnya')) }}

                        </td>
                    </tr>
                    <tr>
                        <th>Subjek</th>
                        <td class="font-weight-bold text-dark">{{ $aduan->subjek }}</td>
                    </tr>
                    <tr>
                        <th>Isi Aduan</th>
                        <td style="white-space: pre-line;" class="text-justify">{{ $aduan->isi_aduan }}</td>
                    </tr>
                    <tr>
                        <th>Lampiran Bukti</th>
                        <td>
                            @if($aduan->lampiran)
                            <a href="{{ asset('storage/' . $aduan->lampiran) }}" target="_blank" class="btn btn-sm btn-info font-weight-bold">
                                <i class="fas fa-paperclip mr-1"></i> Lihat / Unduh Lampiran
                            </a>
                            @else
                            <span class="text-muted font-italic">Tidak ada lampiran terlampir</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ $aduan->created_at ? $aduan->created_at->format('d F Y - H:i') : '-' }} WIB</td>
                    </tr>
                </tbody>
            </table>

            <hr class="my-4">

            <!-- Form Process & Response -->
            <div class="bg-light p-3 rounded border">
                <h5 class="mb-3 font-weight-bold">
                    <i class="fas fa-user-shield mr-1"></i> Form Tindak Lanjut & Tanggapan Jurusan
                </h5>

                <form action="{{ route('aduan.updateStatus', $aduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Status -->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label font-weight-bold">
                            Status Aduan <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-4">
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="menunggu" {{ old('status', $aduan->status) == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="diproses" {{ old('status', $aduan->status) == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="selesai" {{ old('status', $aduan->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="ditolak" {{ old('status', $aduan->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>

                            @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Tanggapan / Balasan -->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label font-weight-bold">
                            Tanggapan / Solusi
                        </label>
                        <div class="col-md-10">
                            <textarea
                                name="tanggapan"
                                rows="5"
                                class="form-control @error('tanggapan') is-invalid @enderror"
                                placeholder="">{{ old('tanggapan', $aduan->tanggapan) }}</textarea>

                            @error('tanggapan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="form-group row mb-0">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-sm btn-primary px-2 btn-radius">
                                Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection