@extends('landing_page.layout')

@section('layout')
<div class="container py-5">
    <h1 class="mb-4 text-center">Menu Makanan</h1>
    <div class="row">
        @forelse ($products as $product)
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $product->foto) }}" class="card-img-top" alt="Foto {{ $product->nama }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->nama }}</h5>
                    <p class="text-muted mb-2">{{ $product->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                    <p class="fw-bold text-primary mb-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="text-muted mb-2">Minimal Pesan: {{ $product->minimal_pesan }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada menu tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection