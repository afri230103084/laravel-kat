@extends('template.master')
@section('title', 'Data Karyawan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Karyawan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('karyawan-index') }}">Data Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Karyawan</li>
        </ol>
    </div>
</div>

<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('karyawan-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan nama karyawan" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Masukkan email karyawan" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" name="telepon" type="text" placeholder="Masukkan nomor telepon" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input class="form-control" name="jabatan" type="text" placeholder="Masukkan jabatan karyawan" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gaji</label>
                            <input class="form-control" name="gaji" type="number" step="0.01" placeholder="Masukkan gaji karyawan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input class="form-control" name="foto" type="file" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. KTP</label>
                            <input class="form-control" name="no_ktp" type="text" placeholder="Masukkan nomor KTP" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input class="form-control" name="tanggal_masuk" type="date" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" cols="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <input class="btn btn-danger" type="reset" value="Batal">
            </div>
        </form>
    </div>
</div>

@endsection
