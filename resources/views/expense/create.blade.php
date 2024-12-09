@extends('template.master')
@section('title', 'Data Pengeluaran')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Pengeluaran</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pengeluaran-index') }}">Data Pengeluaran</a></li>
            <li class="breadcrumb-item active">Tambah Pengeluaran</li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('pengeluaran-store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pengeluaran</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan nama pengeluaran" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input class="form-control" name="jumlah" type="number" placeholder="Masukkan jumlah pengeluaran" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Pengeluaran</label>
                            <input class="form-control" name="tanggal_pengeluaran" type="date" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi pengeluaran"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Batal</button>
            </div>
        </form>
    </div>
</div>

@endsection
