@extends('template.master')
@section('title', 'Data Pengeluaran')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Pengeluaran</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pengeluaran-index') }}">Data Pengeluaran</a></li>
            <li class="breadcrumb-item active">Edit Pengeluaran</li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('pengeluaran-update', $expense->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Pengeluaran</label>
                            <input class="form-control" name="nama" type="text" value="{{ $expense->nama }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input class="form-control" name="jumlah" type="number" value="{{ $expense->jumlah }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pengeluaran</label>
                            <input class="form-control" name="tanggal_pengeluaran" type="date" value="{{ $expense->tanggal_pengeluaran }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3">{{ $expense->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
