@extends('template.master')
@section('title', 'Daftar Pesanan')

@section('content')
<div class="container">
    <h3>Daftar Pesanan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Status</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->kode_transaksi }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>Rp{{ number_format($order->total_harga, 2) }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
