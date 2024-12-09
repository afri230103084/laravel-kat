@extends('template.master')
@section('title', 'Data Menu')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Menu</h4>
        <a href="{{ route('produk-create') }}" class="btn btn-primary">Tambah Menu</a>
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
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 40, ' ...') }}</td>
                            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->status == "aktif")
                                    <span class="badge badge-primary">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Menu" width="50" height="50">
                                @else
                                    <span>Tanpa Foto</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('produk-edit', $item->id) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('produk-destroy', $item->id) }}" class="text-danger">
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