@extends('template.master')
@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <h2>Selamat datang Administrator</h2>
    <p class="lead">Semoga hari Anda menyenangkan dan penuh produktivitas.</p>
    <div class="row mt-4">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="star"></i></div>
                        <div class="media-body"><span class="m-0">Pesanan Selesai</span>
                            <h4 class="mb-0 counter">{{ $totalOrderSelesai }}</h4><i class="icon-bg" data-feather="star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-success b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="dollar-sign"></i></div>
                        <div class="media-body"><span class="m-0">Penjualan</span>
                            <h4 class="mb-0 counter">Rp{{ number_format($totalHargaSelesai, 0, ',', '.') }}</h4><i class="icon-bg" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-danger b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="tag"></i></div>
                        <div class="media-body"><span class="m-0">Pengeluaran</span>
                            <h4 class="mb-0 counter">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</h4><i class="icon-bg" data-feather="tag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        <h4>Pesanan Online Masuk</h4>
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
                            <th>Status</th>
                            <th>Total Harga</th>
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
                                    <span class="badge 
                                        @if ($order->status === 'baru') badge-primary
                                        @elseif ($order->status === 'konfirmasi') badge-success
                                        @elseif ($order->status === 'batal') badge-danger
                                        @else badge-secondary @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($order->total_harga) }}</td>
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Bukti Pembayaran</span>
                        @if ($order->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank" class="btn btn-primary btn-sm">
                                Lihat Bukti Pembayaran
                            </a>
                        @else
                            <span class="text-muted">Belum Ada Bukti Pembayaran</span>
                        @endif
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
            <form action="{{ route('confirmIncomingOrder', $order->id) }}" method="POST">
                <div class="modal-footer w-100">
                    <div class="text-start w-100 mb-3">
                        @csrf
                        <div class="form-group">
                            <label for="jumlah_dibayar">Total Dibayar</label>
                            <input type="number" step="0.01" id="jumlah_dibayar{{ $order->id }}" name="jumlah_dibayar" class="form-control" placeholder="Masukkan jumlah pembayaran"
                                oninput="cekStatusPembayaran({{ $order->total_harga }}, {{ $order->id }})" required>
                        </div>
                        <div class="alert alert-info" id="statusPembayaran{{ $order->id }}">
                            Masukkan jumlah pembayaran.
                        </div>
                        <small class="text-muted d-block mb-1">
                            <strong>Konfirmasi Pesanan:</strong> Dengan mengonfirmasi pesanan ini, status akan berubah menjadi <strong>"Menunggu untuk Dibuat"</strong>.
                        </small>
                        <div class="text-right w-100 mb-3">
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi Pembayaran</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    function cekStatusPembayaran(totalHarga, id) {
        const inputDibayar = document.getElementById('jumlah_dibayar' + id).value;
        const statusPembayaran = document.getElementById('statusPembayaran' + id);

        if (inputDibayar >= totalHarga) {
            statusPembayaran.textContent = 'Status Pembayaran: LUNAS';
        } else {
            statusPembayaran.textContent = 'Status Pembayaran: DP (Belum Lunas)';
        }
    }
</script>
