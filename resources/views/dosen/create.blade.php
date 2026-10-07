@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">

            <div class="card-header text-center">
                <h4><strong>Tambah Dosen</strong></h4>
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
                    <!-- ini role baru -->
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">
                            Role
                        </label>
                        <div class="col-md-6">
                            @foreach($roles as $role)
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" aria-label="Checkbox for following text input"
                                            {{ is_array(old('roles')) && in_array($role->name, old('roles')) ? 'checked': '' }}>
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
                            <div class="position-relative">
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control pe-5 @error('password') is-invalid @enderror">

                                <button class="btn p-0 border-0 text-secondary position-absolute"
                                    type="button"
                                    id="togglePassword"
                                    style="right: 12px; top: 50%; transform: translateY(-50%); z-index: 5; background: transparent;">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>

                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-radius">
                                Tambah
                            </button>

                            <a href="{{ route('dosen.index') }}"
                                class="btn btn-secondary btn-sm bg-abu-abu btn-radius">
                                Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Script Intip Password --}}
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