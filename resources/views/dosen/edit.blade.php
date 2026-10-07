@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header font-weight-bold text-center">
                <h4><strong>Edit Dosen</strong></h4>
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

                    <!-- role -->
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4 text-md-end">
                            Role
                        </label>
                        <div class="col-md-6">
                            @foreach($roles as $role)
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" aria-label="Checkbox for following text input" {{ (is_array(old('roles')) && in_array($role->name, old('roles'))) || (!old('roles') && $dosen->user->roles->contains('name', $role->name)) ? 'checked' : '' }}>

                                    </div>
                                </div>
                                @if($role->name == 'Kajur')
                                <input type="text" class="form-control bg-white" aria-label="Text input with checkbox" value="Ketua Jurusan" readonly>
                                @elseif($role->name == 'DosenKemahasiswaan')
                                <input type="text" class="form-control bg-white" aria-label="Text input with checkbox" value="Dosen Pembina Kemahasiswaan" readonly>
                                @elseif($role->name == 'Dosen')
                                <input type="text" class="form-control bg-white" aria-label="Text input with checkbox" value="Dosen" readonly>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @error('roles')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end role -->

                    {{-- Password Baru --}}
                    <div class="mb-3 row">
                        <label for="password" class="col-form-label col-md-4 text-md-end">
                            Password Baru
                        </label>
                        <div class="col-md-6">
                            <div class="position-relative">
                                <input
                                    type="password"
                                    class="form-control pe-5 @error('password') is-invalid @enderror"
                                    name="password"
                                    id="password">

                                <button class="btn p-0 border-0 text-secondary position-absolute"
                                    type="button"
                                    id="togglePassword"
                                    style="right: 12px; top: 50%; transform: translateY(-50%); z-index: 5; background: transparent;">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>

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
                            <button type="submit" class="btn btn-primary btn-sm btn-radius">
                                Simpan
                            </button>
                            <a href="{{ route('dosen.index') }}" class="btn bg-abu-abu btn-sm btn-radius text-white">
                                Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Script Toggle Intip Password --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>

@endsection