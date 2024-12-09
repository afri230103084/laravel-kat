@extends('template.master')
@section('title', 'Data Gaji Karyawan')

@section('content')
<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Gaji Karyawan</h4>
        <a href="{{ route('gaji-create') }}" class="btn btn-primary">Tambah Gaji</a>
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
                            <th>Nama Karyawan</th>
                            <th>Jumlah Gaji</th>
                            <th>Tanggal Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gaji->nama }}</td>
                                <td>Rp. {{ number_format($gaji->amount, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($gaji->salary_date)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('gaji-destroy', $gaji->id) }}" class="text-danger">
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
