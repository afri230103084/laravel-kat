@extends('template.master')
@section('title', 'Data Karyawan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Karyawan</h4>
        <a href="{{ route('karyawan-create') }}" class="btn btn-primary">Tambah Karyawan</a>
    </div>
</div>

<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="basic-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jabatan</th>
                            <th>Gaji</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>Rp {{ number_format($item->gaji, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('karyawan-edit', $item->id) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('karyawan-destroy', $item->id) }}" class="text-danger">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
