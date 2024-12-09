@extends('template.master')
@section('title', 'Data Menu')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Menu</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk-index') }}">Data Menu</a></li>
            <li class="breadcrumb-item active">Tambah Menu</li>
          </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('produk-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan nama menu" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori Menu</label>
                            <select class="js-example-basic-single col-sm-12" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi menu" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga</label>
                            <input class="form-control" name="harga" type="number" placeholder="Masukkan harga menu" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Minimal Pesan</label>
                            <input class="form-control" name="minimal_pesan" type="number" placeholder="Masukkan minimal pesan" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="js-example-basic-single col-sm-12" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input class="form-control" name="foto" type="file" accept="image/*" required>
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