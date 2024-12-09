@extends('template.master')
@section('title', 'Data Menu')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Menu Item</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('produk-index') }}">Data Menu</a></li>
            <li class="breadcrumb-item active">Edit Menu</li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('produk-update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input class="form-control" name="nama" type="text" value="{{ $produk->nama }}" placeholder="Masukkan nama menu" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori Menu</label>
                            <select class="js-example-basic-single col-sm-12" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $produk->kategori_id == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi menu" required>{{ $produk->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga</label>
                            <input class="form-control" name="harga" type="number" value="{{ $produk->harga }}" placeholder="Masukkan harga menu" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Minimal Pesan</label>
                            <input class="form-control" name="minimal_pesan" type="number" value="{{ $produk->minimal_pesan }}" placeholder="Masukkan minimal pesan" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="js-example-basic-single col-sm-12" name="status">
                                <option value="aktif" {{ $produk->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $produk->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input class="form-control" name="foto" type="file" accept="image/*">
                            @if($produk->foto)
                                <div class="mt-3 text-center">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" 
                                         alt="Foto Menu" 
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
            </div>
        </form>
    </div>
</div>

@endsection