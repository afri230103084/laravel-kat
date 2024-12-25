@extends('template.master')
@section('title', 'Data Pengeluaran')

@section('content')

<div class="col-sm-12">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #3CB371; color: white; border-left: 5px solid #2E7D32;">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pengeluaran</h4>
        <a href="{{ route('pengeluaran-create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
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
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pengeluaran</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ number_format($item->jumlah, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('pengeluaran-edit', $item) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('pengeluaran-destroy', $item) }}" class="text-danger">
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
