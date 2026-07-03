@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header">
                <div class="float-start">Tambah Dosen</div>
            </div>

            <div class="card-body">
                <form action="{{ route('dosen.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Nama
                        </label>
                        <div class="col-md-6">
                            <input type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Email
                        </label>
                        <div class="col-md-6">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            NIP
                        </label>
                        <div class="col-md-6">
                            <input type="text"
                                name="nip"
                                value="{{ old('nip') }}"
                                class="form-control @error('nip') is-invalid @enderror">

                            @error('nip')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Role / Jabatan
                        </label>
                        <div class="col-md-6">
                            {{-- 1. name diubah menjadi format array 'roles[]' --}}
                            {{-- 2. Menambahkan atribut 'multiple' dan style tinggi baris --}}
                            <select name="roles[]"
                                class="form-control @error('roles') is-invalid @enderror"
                                multiple
                                style="height: 120px;">

                                @foreach ($roles as $role)
                                {{-- 3. Menggunakan in_array() untuk mengecek data yang sebelumnya dipilih saat gagal validasi --}}
                                <option value="{{ $role->name }}"
                                    {{ is_array(old('roles')) && in_array($role->name, old('roles')) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                                @endforeach

                            </select>
                            <small class="form-text text-muted">Tahan tombol <strong>Ctrl</strong> (Windows) atau <strong>Command</strong> (Mac) untuk memilih lebih dari satu role.</small>

                            @error('roles')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Password
                        </label>
                        <div class="col-md-6">
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Tambah
                            </button>

                            <a href="{{ route('dosen.index') }}"
                                class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection