@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col m-4">

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Edit Lomba</div>
                    <div><a href="{{ route('info-lomba.index') }}" class="btn btn-primary btn-sm">&larr;</i> Back</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('info-lomba.update', $infoLomba->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="nama_lomba" class="col-form-label col-md-4 text-md-end text-start">Nama Lomba</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('nama_lomba') is_invalid @enderror" name="nama_lomba" value="{{ old('nama_lomba',$infoLomba->nama_lomba) }}" id="nama_lomba">
                            @if($errors->has('nama_lomba'))
                            <span class="text-danger">{{ $errors->first('nama_lomba') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="deskripsi" class="col-form-label col-md-4 text-md-end text-start">Deskripsi</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('deskripsi') is_invalid @enderror" name="deskripsi" value="{{ old('deskripsi',$infoLomba->deskripsi) }}" id="deskripsi">
                            @if($errors->has('deskripsi'))
                            <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="penyelenggara" class="col-form-label col-md-4 text-md-end text-start">Penyelenggara</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('penyelenggara') is_invalid @enderror" name="penyelenggara" value="{{ old('penyelenggara',$infoLomba->penyelenggara) }}" id="penyelenggara">
                            @if($errors->has('penyelenggara'))
                            <span class="text-danger">{{ $errors->first('penyelenggara') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="tanggal_mulai_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">Tanggal Mulai Pendaftaran</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_mulai_pendaftaran') is_invalid @enderror" name="tanggal_mulai_pendaftaran" value="{{ old('tanggal_mulai_pendaftaran',$infoLomba->tanggal_mulai_pendaftaran) }}" id="tanggal_mulai_pendaftaran">
                            @if($errors->has('tanggal_mulai_pendaftaran'))
                            <span class="text-danger">{{ $errors->first('tanggal_mulai_pendaftaran') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="tanggal_selesai_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">Tanggal Selesai Pendaftaran</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tanggal_selesai_pendaftaran') is_invalid @enderror" name="tanggal_selesai_pendaftaran" value="{{ old('tanggal_selesai_pendaftaran', $infoLomba->tanggal_selesai_pendaftaran) }}" id="tanggal_selesai_pendaftaran">
                            @if($errors->has('tanggal_selesai_pendaftaran'))
                            <span class="text-danger">{{ $errors->first('tanggal_selesai_pendaftaran') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="link_pendaftaran" class="col-form-label col-md-4 text-md-end text-start">Link Pendaftaran</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('link_pendaftaran') is_invalid @enderror" name="link_pendaftaran" value="{{ old('link_pendaftaran',$infoLomba->link_pendaftaran) }}" id="link_pendaftaran">
                            @if($errors->has('link_pendaftaran'))
                            <span class="text-danger">{{ $errors->first('link_pendaftaran') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="contact_person" class="col-form-label col-md-4 text-md-end text-start">Contact Person</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('contact_person') is_invalid @enderror" name="contact_person" value="{{ old('contact_person',$infoLomba->contact_person) }}" id="contact_person">
                            @if($errors->has('contact_person'))
                            <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="btn btn-primary btn-sm offset-md-5 col-md-3" value="Edit lomba">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection