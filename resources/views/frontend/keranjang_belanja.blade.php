@extends('template.master')
@section('title', 'Keranjang Pesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-10">
            <h2 class="mb-4 text-center fw-bold text-dark">Keranjang Belanja</h2>

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold text-dark">Pesanan #{{ $order->kode_transaksi }}</h5>
                            <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small>
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
                                    <a href="{{ route('frontend-HapusKeranjangBelanja', $order->id) }}" 
                                       class="btn btn-outline-danger btn-sm me-2"
                                       onclick="return confirm('Hapus pesanan ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                    <a href="{{ route('frontend-konfirmasiKeranjang', $order->id) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="bi bi-check-circle"></i> Konfirmasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Keranjang belanja Anda kosong</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
