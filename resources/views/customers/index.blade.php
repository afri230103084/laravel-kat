@extends('template.master')
@section('title', 'Pelanggan')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pelanggan</h4>
        <a href="{{ route('pelanggan-create') }}" class="btn btn-primary">Tambah Pelanggan</a>
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
                            <th>Alamat</th>
                            <th>Tipe Akun</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->alamat, 35, ' ...') }}</td>
                            <td>
                                @if ($item->tipe_akun == "individu")
                                    <span class="badge badge-info">Individu</span>
                                @elseif ($item->tipe_akun == "perusahaan")
                                    <span class="badge badge-success">Perusahaan</span>
                                @else
                                    <span class="badge badge-warning">Instansi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pelanggan-edit', $item->id) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('pelanggan-destroy', $item->id) }}" class="text-danger">
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
