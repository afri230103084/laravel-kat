@extends('template.master')
@section('title', 'Kategori Menu')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Kategori Menu</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kategori-index') }}">Data Kategori Menu</a></li>
            <li class="breadcrumb-item active">Edit Kategori Menu</li>
          </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('kategori-update', $kategori->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input class="form-control" name="nama" type="text" value="{{ $kategori->nama }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="js-example-basic-single col-sm-12" name="status">
                                <option value="aktif" {{ $kategori->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $kategori->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3">{{ $kategori->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection