@extends('template.master')
@section('title', 'Daftar Pesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-10">
            <h2 class="mb-4 text-center fw-bold text-dark">Daftar Pesanan</h2>

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold text-dark">Pesanan #{{ $order->kode_transaksi }}</h5>
                            <span class="badge badge-warning">
                                @if($order->status == 'baru') 
                                    Belum Dikonfirmasi
                                @elseif($order->status == 'menunggu') 
                                    Tunggu Pesanan dibuat
                                @elseif($order->status == 'dibuat') 
                                    Sedang Dimasak
                                @elseif($order->status == 'diantar') 
                                    Sedang Diantar
                                @elseif($order->status == 'selesai') 
                                    Selesai Dimasak
                                @elseif($order->status == 'batal') 
                                    Pesanan Dibatalkan
                                @elseif($order->status == 'transaksi_selesai') 
                                    Pesanan Selesai
                                @endif
                            </span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-3">
                                    <tbody>
                                        @foreach($order->order_items as $item)
                                            <tr>
                                                <td class="ps-0 py-2 w-50">
                                                    <span class="fw-medium">{{ $item->product->nama }}</span>
                                                </td>
                                                <td class="text-center py-2 w-25">
                                                    <span class="text-muted">{{ $item->jumlah }} x</span>
                                                </td>
                                                <td class="text-end pe-0 py-2 w-25">
                                                    <span class="fw-semibold">
                                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fw-bold text-dark">
                                    Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#orderItemsModal{{ $order->id }}">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Tidak ada pesanan</p>
                </div>
            @endif
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
                        <span class="badge badge-warning">{{ strtoupper($order->status_pembayaran) }}</span>
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
        </div>
    </div>
</div>
@endforeach
