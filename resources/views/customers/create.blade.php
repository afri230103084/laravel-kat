@extends('template.master')
@section('title', 'Pelanggan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Pelanggan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan-index') }}">Data Pelanggan</a></li>
            <li class="breadcrumb-item active">Tambah Pelanggan</li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('pelanggan-store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan nama Pelanggan" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Akun</label>
                            <select class="js-example-basic-single col-sm-12"  name="tipe_akun" required>
                                <option value="individu">Individu</option>
                                <option value="perusahaan">Perusahaan</option>
                                <option value="instansi">Instansi</option>
                            </select>
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
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Masukkan email" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat Pelanggan" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota</label>
                            <input class="form-control" name="kota" type="text" placeholder="Masukkan kota" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input class="form-control" name="kode_pos" type="text" placeholder="Masukkan kode pos" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input class="form-control" name="provinsi" type="text" placeholder="Masukkan provinsi" required autocomplete="off">
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
