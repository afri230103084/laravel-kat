@extends('template.master')
@section('title', 'Gaji Karyawan')

@section('content')
<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Gaji Karyawan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('gaji-index') }}">Data Gaji Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Gaji</li>
        </ol>
    </div>
</div>

<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('gaji-store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employee_id">Nama Karyawan</label>
                            <select class="js-example-basic-single col-sm-12" name="employee_id" id="employee_id" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_date">Tanggal Gaji</label>
                            <input class="form-control" type="date" name="salary_date" id="salary_date" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button type="reset" class="btn btn-danger">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
