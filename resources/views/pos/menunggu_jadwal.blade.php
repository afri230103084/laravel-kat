@extends('template.master')
@section('title', 'Menunggu Jadwal')

@section('content')

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Menunggu Jadwal</h4>
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
                            <th>Status Pesanan</th>
                            <th>Jenis Pengambilan</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Acara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->customers->nama ?? 'Tidak Diketahui' }}</td>
                                <td>
                                    <span class="badge badge-warning">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($order->jenis_pengambilan) }}</td>
                                <td>
                                    <span class="badge 
                                        @if ($order->status_pembayaran === 'dp') badge-warning @else badge-success @endif">
                                        {{ ucfirst($order->status_pembayaran) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $order->tanggal_acara }} <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($order->tanggal_acara)->diffForHumans() }}
                                    </small>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#orderItemsModal{{ $order->id }}">Detail</button>
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

@foreach ($orders as $order)
<div class="modal fade bd-example-modal-lg" id="orderItemsModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderItemsModal{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderItemsModalLabel{{ $order->id }}">Informasi Pesanan {{ $order->kode_transaksi }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Kode Transaksi</span>
                        <strong>{{ $order->kode_transaksi }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Nama Pelanggan</span>
                        <strong>{{ $order->customers->nama ?? 'Tidak Diketahui' }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Tanggal Acara</span>
                        <strong>{{ $order->tanggal_acara }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Waktu Acara</span>
                        <strong>{{ $order->waktu_acara }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Metode Pengambilan</span>
                        <strong>{{ ucfirst($order->jenis_pengambilan) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Status Pesanan</span>
                        <span class="badge badge-info">{{ ucfirst($order->status) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Status Pembayaran</span>
                        <span class="badge badge-warning">{{ ucfirst($order->status_pembayaran) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Metode Pembayaran</span>
                        <strong>{{ ucfirst($order->metode_pembayaran) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Total Harga</span>
                        <strong>Rp{{ number_format($order->total_harga, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Jumlah Dibayar</span>
                        <strong>Rp{{ number_format($order->jumlah_dibayar, 2) }}</strong>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">Catatan</h6>
                        <p class="mb-0 text-muted">{{ $order->catatan }}</p>
                    </li>
                    <div class="card mt-3">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-right">Harga Satuan</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                @foreach ($order->order_items as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ $item->product->nama }}</td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                        <td class="text-right">Rp {{ number_format($item->harga_satuan, 2) }}</td>
                                        <td class="text-right">Rp {{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="modal-footer w-100">
                <div class="text-start w-100 mb-3">
                    <small class="text-muted d-block mb-1">
                        <strong>Proses Pesanan:</strong> Dengan mengonfirmasi pesanan ini, status akan berubah menjadi <strong>"Pesanan Dibuat"</strong> menandakan bahwa pesanan diproses.
                    </small>
                    <small class="text-muted">
                        <strong>Batalkan Pesanan:</strong> Dengan membatalkan pesanan ini, status akan berubah menjadi <strong>"Dibatalkan"</strong>.
                    </small>
                </div>
                <div class="text-right w-100 mb-3">
                    <a href="/menunggu-jadwal/confirm/{{ $order->id }}" class="btn btn-success btn-sm">Proses Pesanan</a>
                    <a href="/menunggu-jadwal/cancel/{{ $order->id }}" class="btn btn-danger btn-sm">Batalkan Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
