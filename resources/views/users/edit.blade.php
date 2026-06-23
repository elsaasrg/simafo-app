@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Edit User</div>
                    <div><a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" id="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" id="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                        <div class="col-md-6">
                            <select class="form-control @error('roles') is-invalid @enderror" multiple aria-label="Roles" name="roles[]" id="roles">
                                @forelse($roles as $role)
                                <option value="{{ $role }}" {{ in_array($role, $userRoles ?? [] ) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                                @empty

                                @endforelse
                            </select>
                            @if($errors->has('roles'))
                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <input type="submit" value="Ubah User" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection