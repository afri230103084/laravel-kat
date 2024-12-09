@extends('template.master')
@section('title', 'Buat Pesanan')

@section('content')

<style>
    #menu-items {
        margin-top: 15px;
    }
    .menu-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
    }
    .menu-item label {
        flex-grow: 1;
        font-size: 14px;
        color: #333;
    }
    .menu-item small {
        font-size: 12px;
        color: #999;
    }
    .menu-item input[type="checkbox"] {
        margin-right: 10px;
    }
    .menu-item input[type="number"] {
        width: 60px;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    @media (max-width: 768px) {
        .menu-item {
            flex-direction: column;
            align-items: flex-start;
        }
        .menu-item input[type="number"] {
            width: 100%;
        }
    }
</style>

<div class="col-sm-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Buat Pesanan</h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('frontend-buat_pesananStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input class="form-control" value="{{  Auth::guard('customer')->user()->nama }}" name="nama" type="text" readonly>
                            <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Acara</label>
                            <input class="form-control" name="tanggal_acara" type="date" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Waktu Acara</label>
                            <input class="form-control" name="waktu_acara" type="time" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukkan alamat pengiriman" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan" placeholder="Masukkan catatan" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Pengambilan</label>
                            <select class="form-control" name="jenis_pengambilan" required>
                                <option value="">Pilih Jenis Pengambilan</option>
                                <option value="diantar">Diantar</option>
                                <option value="diambil">Diambil</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select class="form-control" name="metode_pembayaran" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilih Menu</label>
                    <div id="menu-items">
                        @foreach ($product as $item)
                            <div class="menu-item" data-harga="{{ $item->harga }}">
                                <input type="checkbox" id="menu-{{ $item->id }}" name="items[{{ $loop->index }}][product_id]" value="{{ $item->id }}">
                                <label for="menu-{{ $item->id }}">
                                    {{ $item->nama }} - Rp{{ number_format($item->harga, 2) }} 
                                    <small>(Minimal Pemesanan: {{ $item->minimal_pesan }})</small>
                                </label>
                                <input type="number" name="items[{{ $loop->index }}][jumlah]" min="{{ $item->minimal_pesan }}" value="{{ $item->minimal_pesan }}" placeholder="Jumlah" disabled>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Total Harga:</strong></label>
                    <p id="total-harga">Rp 0</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah Dibayar</label>
                            <input class="form-control" type="number" name="jumlah_dibayar" id="jumlah-dibayar" placeholder="Masukkan jumlah yang dibayar" required>
                            <small id="status-pembayaran-info" class="text-muted"></small>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group" id="bukti-pembayaran-container" style="display: none;">
                            <label>Bukti Pembayaran</label>
                            <input class="form-control" type="file" name="bukti_pembayaran" accept="image/*">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Buat Pesanan</button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');
    const totalHargaElement = document.getElementById('total-harga');
    const jumlahDibayarInput = document.getElementById('jumlah-dibayar');
    const statusInfo = document.getElementById('status-pembayaran-info');
    const metodePembayaranSelect = document.querySelector('select[name="metode_pembayaran"]');
    const buktiPembayaranContainer = document.getElementById('bukti-pembayaran-container');

    const updateTotalHarga = () => {
        let totalHarga = 0;
        menuItems.forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const jumlahInput = item.querySelector('input[type="number"]');
            const harga = parseFloat(item.dataset.harga);

            if (checkbox.checked) {
                totalHarga += harga * (jumlahInput.value || 0);
            }
        });
        totalHargaElement.textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
    };

    menuItems.forEach(item => {
        const checkbox = item.querySelector('input[type="checkbox"]');
        const jumlahInput = item.querySelector('input[type="number"]');

        checkbox.addEventListener('change', () => {
            jumlahInput.disabled = !checkbox.checked;
            if (!checkbox.checked) jumlahInput.value = '';
            updateTotalHarga();
        });

        jumlahInput.addEventListener('input', updateTotalHarga);
    });

    jumlahDibayarInput.addEventListener('input', () => {
        const totalHarga = parseInt(totalHargaElement.textContent.replace(/[^0-9]/g, ''), 10) || 0;
        const jumlahDibayar = parseInt(jumlahDibayarInput.value, 10) || 0;

        if (jumlahDibayar >= totalHarga) {
            statusInfo.textContent = 'Status Pembayaran: Lunas';
        } else {
            statusInfo.textContent = 'Status Pembayaran: DP';
        }
    });

    metodePembayaranSelect.addEventListener('change', () => {
        buktiPembayaranContainer.style.display = metodePembayaranSelect.value === 'transfer' ? 'block' : 'none';
    });
});
</script>