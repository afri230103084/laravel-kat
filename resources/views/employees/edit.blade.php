@extends('template.master')
@section('title', 'Data Karyawan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Karyawan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('karyawan-index') }}">Data Karyawan</a></li>
            <li class="breadcrumb-item active">Edit Karyawan</li>
        </ol>
    </div>
</div>

<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('karyawan-update', $employees) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" name="nama" type="text" value="{{ $employees->nama }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="{{ $employees->email }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" name="telepon" type="text" value="{{ $employees->telepon }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input class="form-control" name="jabatan" type="text" value="{{ $employees->jabatan }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. KTP</label>
                            <input class="form-control" name="no_ktp" type="text" value="{{ $employees->no_ktp }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input class="form-control" name="tanggal_masuk" type="date" value="{{ $employees->tanggal_masuk }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gaji</label>
                            <input class="form-control" name="gaji" type="number" step="0.01" value="{{ $employees->gaji }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" cols="3">{{ $employees->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input class="form-control" name="foto" type="file" accept="image/*">
                            @if($employees->foto)
                                <div class="mt-3 text-center">
                                    <img src="{{ asset('storage/' . $employees->foto) }}"
                                        alt="Foto Karyawan"
                                        class="img-thumbnail rounded shadow-sm"
                                        style="max-width: 250px; max-height: 250px; object-fit: cover;">
                                    <p class="text-muted mt-2">Foto Saat Ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="{{ route('karyawan-index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
