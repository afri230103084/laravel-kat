@extends('template.master')
@section('title', 'Data Menu')

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
                            <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 60, ' ...') }}</td>
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
                                <form action="{{ route('produk-destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger bg-transparent border-0 p-0">
                                        <i data-feather="trash"></i>
                                    </button>
                                </form>
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