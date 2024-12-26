@extends('template.master')
@section('title', 'Pelanggan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Pelanggan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan-index') }}">Data Pelanggan</a></li>
            <li class="breadcrumb-item active">Edit Pelanggan</li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('pelanggan-update', $customer) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input class="form-control" name="nama" type="text" value="{{ $customer->nama }}" placeholder="Masukkan nama pelanggan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Akun</label>
                            <select class="js-example-basic-single col-sm-12" name="tipe_akun" required>
                                <option value="individu" {{ $customer->tipe_akun == 'individu' ? 'selected' : '' }}>Individu</option>
                                <option value="perusahaan" {{ $customer->tipe_akun == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                <option value="instansi" {{ $customer->tipe_akun == 'instansi' ? 'selected' : '' }}>Instansi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" name="telepon" type="text" value="{{ $customer->telepon }}" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="{{ $customer->email }}" placeholder="Masukkan email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat pelanggan" required>{{ $customer->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota</label>
                            <input class="form-control" name="kota" type="text" value="{{ $customer->kota }}" placeholder="Masukkan kota" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input class="form-control" name="kode_pos" type="text" value="{{ $customer->kode_pos }}" placeholder="Masukkan kode pos" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input class="form-control" name="provinsi" type="text" value="{{ $customer->provinsi }}" placeholder="Masukkan provinsi" required>
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
