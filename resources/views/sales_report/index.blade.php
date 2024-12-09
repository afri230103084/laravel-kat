@extends('template.master')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Laporan Penjualan</h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="basic-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Kode Transaksi</th>
                            <th>Jenis Pengambilan</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Jumlah Dibayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->nama ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $order->kode_transaksi }}</td>
                                <td>{{ ucfirst($order->jenis_pengambilan) }}</td>
                                <td>{{ ucfirst($order->metode_pembayaran) }}</td>
                                <td>{{ number_format($order->total_harga, 2) }}</td>
                                <td>{{ number_format($order->jumlah_dibayar, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection