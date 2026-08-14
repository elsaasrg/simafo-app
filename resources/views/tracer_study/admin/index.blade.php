@extends('layouts.app')

@section('content')

<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="col-12">

            {{-- Bagian Pencarian & Filter --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('tracer-study.index') }}" method="GET">
                        <div class="row">
                            {{-- Input Kata Kunci (Nama / NIM) --}}
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small">Cari Alumni (Nama / NIM)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Ketik nama atau NIM..."
                                        value="{{ request('search') }}">
                                </div>
                            </div>

                            {{-- Filter Tahun Lulus --}}
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small">Tahun Lulus / Angkatan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-muted"></i></span>
                                    </div>
                                    <select name="tahun" class="form-control">
                                        <option value="">-- Semua Tahun Lulus --</option>
                                        @for ($year = date('Y'); $year >= 2015; $year--)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                            Lulusan Tahun {{ $year }}
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Status (Bekerja / Tidak) --}}
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small">Status Saat Ini</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-briefcase text-muted"></i></span>
                                    </div>
                                    <select name="status" class="form-control">
                                        <option value="">-- Semua Status --</option>
                                        <option value="bekerja" {{ request('status') == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                                        <option value="wiraswasta" {{ request('status') == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta / Wirausaha</option>
                                        <option value="kuliah" {{ request('status') == 'kuliah' ? 'selected' : '' }}>Studi Lanjut (Kuliah)</option>
                                        <option value="mencari_kerja" {{ request('status') == 'mencari_kerja' ? 'selected' : '' }}>Mencari Kerja / Tidak Bekerja</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi Filter --}}
                        <div class="d-flex justify-content-end">
                            @if(request()->filled('search') || request()->filled('tahun') || request()->filled('status'))
                            <a href="{{ route('tracer-study.index') }}" class="btn btn-secondary btn-sm mr-2 d-flex align-items-center">
                                <i class="fas fa-redo mr-1"></i> Reset Filter
                            </a>
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="fas fa-filter mr-1"></i> Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Utama Data Alumni --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white  text-center">
                    <h5 class="m-0 font-weight-bold text-dark ">
                        <i class="fas fa-sitemap me-1 mr-2"></i>
                        Tracer Study
                    </h5>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover m-0">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 8%;">No</th>
                                    <th>Nama Alumni</th>
                                    <th style="width: 15%;">NIM</th>
                                    <th style="width: 15%;">Tahun Lulus</th>
                                    <th style="width: 20%;">Status Saat Ini</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tracerstudy as $item)
                                <tr>
                                    <td class="text-center align-middle">
                                        {{ $loop->iteration + ($tracerstudy->firstItem() - 1) }}
                                    </td>
                                    <td class="align-middle text-dark pl-3">
                                        {{ $item->mahasiswa->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $item->mahasiswa->nim ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $item->mahasiswa->tahun_lulus ?? $item->tahun_lulus ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                        $statusLower = Str::lower($item->status_saat_ini);
                                        @endphp

                                        @if(Str::contains($statusLower, 'bekerja') && !Str::contains($statusLower, 'tidak'))
                                        Bekerja
                                        @elseif(Str::contains($statusLower, 'wiraswasta') || Str::contains($statusLower, 'wirausaha'))
                                        Wiraswasta
                                        @elseif(Str::contains($statusLower, 'kuliah') || Str::contains($statusLower, 'studi lanjut') || Str::contains($statusLower, 'pendidikan'))
                                        Studi Lanjut
                                        @else
                                        </i> {{ $item->status_saat_ini ?? 'Mencari Kerja' }}
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center align-items-center">

                                            <a href="{{ route('tracer-study.show', $item->id) }}"
                                                class="btn bg-yellow-3 btn-sm btn-radius mx-1"
                                                style="padding: .25rem .4rem;"
                                                title="Lihat Detail Lengkap">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- Tombol Hapus --}}

                                            <form action="{{ route('tracer-study.destroy', $item->id) }}" method="POST" class="d-inline m-0 mx-1">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data Tracer Study ini?');"
                                                    class="btn btn-danger btn-sm btn-radius"
                                                    style="padding: .25rem .4rem;"
                                                    title="Hapus Data">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        </i>
                                        Tidak ada data alumni yang tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Navigasi Pagination --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $tracerstudy->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection