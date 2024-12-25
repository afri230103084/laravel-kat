@extends('landing_page.layout')

@section('layout')
    <h1 class="mb-4 text-center">Kategori Menu</h1>
    <div class="row">
        @forelse ($categories as $category)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('cuba') }}/assets/images/login/tess.jpg" class="card-img-top" alt="Foto Kategori {{ $category->nama }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $category->nama }}</h5>
                    <p class="card-text text-muted">{{ $category->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada data kategori.</p>
        </div>
        @endforelse
    </div>
@endsection