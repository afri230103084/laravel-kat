@extends('template.master')
@section('title', 'Buat Pesanan')

@section('content')

<style>
    .row.g-4 > [class^="col"] {
        padding-bottom: 20px;
    }
    .menu-item {
        border: none;
        border-radius: 10px;
        background-color: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .menu-item:hover {
        transform: translateY(-7px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .menu-item img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 200px;
        object-fit: cover;
    }
    .card-body {
        padding: 20px 15px;
    }
    .card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    .card-text {
        font-size: 13px;
        margin-bottom: 12px;
        color: #777;
    }
    .badge {
        font-size: 13px;
        padding: 5px 10px;
        border-radius: 20px;
    }
    input[type="checkbox"] {
        margin-right: 5px;
    }
    .form-control-sm {
        font-size: 14px;
        height: 30px;
    }
    .total-harga-card {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .total-harga-card .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .total-harga-card h4 {
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
        margin: 0;
    }
    .total-harga-card label {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 768px) {
        .row.g-4 > [class^="col"] {
            padding-bottom: 10px;
        }
        .col-lg-3.col-md-4.col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .menu-item {
            margin-bottom: 15px;
        }
        .menu-item img {
            height: 150px;
        }
        .card-title {
            font-size: 14px;
        }
        .badge {
            font-size: 12px;
        }
        .form-control-sm {
            width: 100%;
            font-size: 13px;
            height: 28px;
        }
        .total-harga-card {
            padding: 10px 12px;
        }
        .total-harga-card h4 {
            font-size: 18px;
        }
        .total-harga-card label {
            font-size: 14px;
        }
        .card-footer button {
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
                    <div id="menu-items" class="row g-4">
                        @foreach ($product as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card menu-item shadow-sm h-100" data-harga="{{ $item->harga }}">
                                    <img src="{{ asset('storage/'.$item->foto) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $item->nama }}</h5>
                                        <span class="badge bg-success mb-2">Rp{{ number_format($item->harga, 2) }}</span>
                                        <p class="card-text"><small>Minimal: {{ $item->minimal_pesan }}</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <input type="checkbox" id="menu-{{ $item->id }}" name="items[{{ $loop->index }}][product_id]" value="{{ $item->id }}">
                                                <label for="menu-{{ $item->id }}" class="form-check-label ms-1">Pilih</label>
                                            </div>
                                            <input type="number" name="items[{{ $loop->index }}][jumlah]" min="{{ $item->minimal_pesan }}" value="{{ $item->minimal_pesan }}" placeholder="Jumlah" class="form-control form-control-sm text-center w-50" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="form-group mt-4">
                    <div class="total-harga-card text-center">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <label for="total-harga" class="mb-0"><strong>Total Harga</strong></label>
                            <h4 id="total-harga" class="mb-0">Rp 0</h4>
                        </div>
                    </div>
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
