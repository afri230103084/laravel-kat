@extends('template.master')
@section('title', 'Pelanggan')

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
                                <form action="{{ route('pelanggan-destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
