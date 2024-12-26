@extends('template.master')
@section('title', 'Pesanan Selesai')

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
        <h4>Pesanan Selesai</h4>
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
                                <td>{{ $order->customer->nama ?? 'Tidak Diketahui' }}</td>
                                <td>
                                    <span class="badge badge-success">
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
            <form action="{{ route('order.finalizeTransaksi', $order) }}" method="post">
                @csrf
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kode Transaksi</span>
                            <strong>{{ $order->kode_transaksi }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Nama Pelanggan</span>
                            <strong>{{ $order->customer->nama ?? 'Tidak Diketahui' }}</strong>
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
                    @if ($order->status_pembayaran === 'dp' && $order->jenis_pengambilan === 'diambil')
                        <hr>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kekurangan-pembayaran">Kekurangan Pembayaran</label>
                                    <input type="text" id="kekurangan-pembayaran{{ $order->id }}" 
                                        class="form-control" value="Rp {{ number_format(max(0, $order->total_harga - $order->jumlah_dibayar), 2) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control"  id="jumlah_pembayaran{{ $order->id }}" name="jumlah_pembayaran" placeholder="Masukkan jumlah pembayaran" required oninput="checkPayment({{ $order->total_harga }}, {{ $order->jumlah_dibayar }}, '{{ $order->id }}')">
                                    <small id="status-pembayaran-info{{ $order->id }}" class="text-muted"></small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer w-100">
                    <div class="text-start w-100 mb-3">
                        <small class="text-muted d-block mb-1">
                            <strong>Jadwal Pengiriman:</strong> Tombol ini digunakan untuk menentukan atau melihat pengiriman pesanan kepada pelanggan.
                        </small>
                        <small class="text-muted">
                            <strong>Transaksi Selesai:</strong> Tombol ini mengubah status pesanan menjadi selesai secara penuh.
                        </small>
                    </div>
                    <div class="text-right w-100 mb-3">
                        @if ($order->jenis_pengambilan == 'diantar')
                            <form action="{{ route('order.jadwalkanPengiriman', $order) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Jadwalkan Pengiriman</button>
                            </form>
                        @else
                            <button type="submit" class="btn btn-success btn-sm">Transaksi Selesai</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    function checkPayment(totalHarga, jumlahDibayar, orderId) {
    const jumlahPembayaranInput = document.getElementById(`jumlah_pembayaran${orderId}`);
    const statusPembayaranInfo = document.getElementById(`status-pembayaran-info${orderId}`);
    const kekuranganPembayaran = totalHarga - jumlahDibayar;

    if (jumlahPembayaranInput) {
        const jumlahPembayaran = parseFloat(jumlahPembayaranInput.value) || 0;

        if (jumlahPembayaran >= kekuranganPembayaran) {
            statusPembayaranInfo.textContent = "Lunas";
            statusPembayaranInfo.classList.remove('text-muted');
            statusPembayaranInfo.classList.add('text-success');
        } else {
            statusPembayaranInfo.textContent = "";
            statusPembayaranInfo.classList.remove('text-success');
            statusPembayaranInfo.classList.add('text-muted');
        }
    }
}
</script>
