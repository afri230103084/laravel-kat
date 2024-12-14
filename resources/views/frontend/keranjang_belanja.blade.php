@extends('template.master')
@section('title', 'Keranjang Pesanan')

@section('content')
    <div class="col-sm-12">
        <h4>Keranjang Pesanan</h4>
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Pesanan #{{ $order->kode_transaksi }}</h5>
                    <ul>
                        @foreach($order->order_items as $item)
                            <li>{{ $item->product->nama }} - Jumlah: {{ $item->jumlah }} - Rp{{ number_format($item->subtotal, 2) }}</li>
                        @endforeach
                    </ul>
                    <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 2) }}</p>
                    <a href="{{ route('frontend-HapusKeranjangBelanja', $order->id) }}" class="btn btn-danger">Hapus Pesanan</a>
                    <a href="{{ route('frontend-konfirmasiKeranjang', $order->id) }}" class="btn btn-primary">Konfirmasi Pesanan</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
