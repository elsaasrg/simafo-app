@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between w-100">
                <div>Tambah User Baru</div>
                <!-- <div><a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"> &larr; Back</a></div> -->
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-form-label col-md-4 text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-form-label col-md-4 text-md-end text-start">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror " id="email" name="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-form-label col-md-4 text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" value="{{ old('password') }}">
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-form-label col-md-4 text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password') }}">
                            @if($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-form-label col-md-4 text-md-end text-start">Roles</label>
                        <div class="col-md-6">
                            <select class="form-control @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                                @forelse($roles as $role)

                                @if(Auth::user()->hasRole('Admin'))
                                <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                                @endif

                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('roles'))
                            <div class="text-danger">{{ $errors->first('roles') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 offset-md-4 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                Tambah User
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection