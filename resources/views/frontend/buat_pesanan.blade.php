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
        <h4>Buat Pesanan - Pilih Menu</h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card">
        <form class="needs-validation" action="{{ route('frontend-buat_pesananStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
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
});
</script>
