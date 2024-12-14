@extends('template.master')
@section('title', 'Konfirmasi Pesanan')

@section('content')
    <div class="col-sm-12">
        <h4>Konfirmasi Pesanan</h4>
        <form action="{{ route('frontend-konfirmasiKeranjangStore', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_acara">Tanggal Acara</label>
                                <input type="date" class="form-control" name="tanggal_acara" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu_acara">Waktu Acara</label>
                                <input type="time" class="form-control" name="waktu_acara" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat Pengiriman</label>
                                <textarea class="form-control" name="alamat" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="catatan">Catatan (Opsional)</label>
                                <textarea class="form-control" name="catatan"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_yang_harus_dibayar"><strong>Jumlah yang Harus Dibayar</strong></label>
                                <input type="text" class="form-control" value="Rp {{ number_format($order->total_harga, 2) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <select class="js-example-basic-single col-sm-12" name="metode_pembayaran">
                                    <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                <input type="file" class="form-control" accept="image/*" name="bukti_pembayaran">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pengambilan">Jenis Pengambilan</label>
                                <select class="js-example-basic-single col-sm-12" name="jenis_pengambilan" required>
                                    <option value="">Pilih Jenis Pengambilan</option>
                                    <option value="diantar" {{ old('jenis_pengambilan') == 'diantar' ? 'selected' : '' }}>Diantar</option>
                                    <option value="diambil" {{ old('jenis_pengambilan') == 'diambil' ? 'selected' : '' }}>Ambil di Tempat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                        <a href="{{ route('frontend-keranjangBelanja') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
