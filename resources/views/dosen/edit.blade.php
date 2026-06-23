@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header font-weight-bold">
                <div class="float-start">Edit Dosen</div>
            </div>

            <div class="card-body">
                {{-- Route diarahkan ke dosen.update dengan menyertakan id dosen --}}
                <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3 row">
                        <label for="name" class="col-form-label col-md-4 text-md-end">
                            Nama
                        </label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                id="name"
                                value="{{ old('name', $dosen->user->name) }}">

                            @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 row">
                        <label for="email" class="col-form-label col-md-4 text-md-end">
                            Email
                        </label>
                        <div class="col-md-6">
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                id="email"
                                value="{{ old('email', $dosen->user->email) }}">

                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3 row">
                        <label for="nip" class="col-form-label col-md-4 text-md-end">
                            NIP
                        </label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control @error('nip') is-invalid @enderror"
                                name="nip"
                                id="nip"
                                value="{{ old('nip', $dosen->nip) }}">

                            @error('nip')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Multiple Pilihan Role / Jabatan --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Role / Jabatan
                        </label>
                        <div class="col-md-6">
                            <select name="roles[]"
                                class="form-control @error('roles') is-invalid @enderror"
                                multiple
                                style="height: 120px;">

                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{-- Logika untuk mengecek data dari input sebelumnya (jika gagal validasi) ATAU dari data yang sudah tersimpan di database user --}}
                                    {{ (is_array(old('roles')) && in_array($role->name, old('roles'))) || (!old('roles') && $dosen->user->roles->contains('name', $role->name)) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                                @endforeach

                            </select>
                            <small class="form-text text-muted">Tahan tombol <strong>Ctrl</strong> (Windows) atau <strong>Command</strong> (Mac) untuk mengubah kombinasi role.</small>

                            @error('roles')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 row">
                        <label for="password" class="col-form-label col-md-4 text-md-end">
                            Password Baru
                        </label>
                        <div class="col-md-6">
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                id="password">

                            <small class="text-muted d-block mt-1">
                                Kosongkan jika tidak ingin mengubah password akun dosen ini.
                            </small>

                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection