@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-purple font-weight-bold"><i class="fas fa-th-large mr-2 mb-4"></i>Dashboard Dosen</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0">
                            Selamat datang, {{ Auth::user()->name }}
                        </p>
                    </div>

                    <div>
                        <span class="badge bg-success p-2">
                            Dosen Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <a href="{{ route('konseling.index') }}">
                <div class="card border-0 shadow-sm bg-purple text-white">
                    <div class="card-body">
                        <h6>Konseling Online</h6>
                        <h2>7</h2>
                    </div>
                </div>
            </a>
        </div>


    </div>



</div>

@endsection