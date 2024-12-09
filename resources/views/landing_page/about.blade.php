@extends('landing_page.layout')

@section('layout')
    <div class="row mb-5">
        <div class="col text-center">
            <h1 class="fw-bold mb-3">Cerita Kami</h1>
            <p class="fs-5 text-muted">
                Katering Mas Kikiw berdiri sejak 2010 dengan tujuan untuk membawa hidangan lezat dan sehat ke setiap rumah tangga.
                Dengan dedikasi tinggi dan komitmen pada kualitas, kami terus menjadi pilihan terbaik untuk momen spesial Anda.
            </p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-eye display-4 text-primary mb-3"></i> <!-- Ikon Visi -->
                    <h3 class="fw-bold">Visi Kami</h3>
                    <p class="text-muted">
                        Menjadi penyedia katering terkemuka yang dikenal karena kelezatan dan kualitas tinggi di seluruh Indonesia.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-bullseye display-4 text-success mb-3"></i> <!-- Ikon Misi -->
                    <h3 class="fw-bold">Misi Kami</h3>
                    <p class="text-muted">
                        Memberikan pengalaman bersantap terbaik melalui hidangan berkualitas, pelayanan ramah, dan pengiriman tepat waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <h2 class="fw-bold mb-4">Testimoni Pelanggan</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/100" alt="Avatar Pelanggan" class="rounded-circle mb-3" width="80" height="80">
                    <h5 class="fw-bold mb-1">Andi Wijaya</h5>
                    <p class="text-muted">"Pelayanan luar biasa! Hidangannya sangat lezat dan cocok untuk acara keluarga."</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/100" alt="Avatar Pelanggan" class="rounded-circle mb-3" width="80" height="80">
                    <h5 class="fw-bold mb-1">Rina Setiawan</h5>
                    <p class="text-muted">"Saya sangat puas dengan kualitas makanan dan pelayanan yang diberikan. Terima kasih Mas Kikiw!"</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/100" alt="Avatar Pelanggan" class="rounded-circle mb-3" width="80" height="80">
                    <h5 class="fw-bold mb-1">Dedi Santoso</h5>
                    <p class="text-muted">"Hidangan yang disajikan selalu segar dan nikmat. Sangat direkomendasikan!"</p>
                </div>
            </div>
        </div>
    </div>
@endsection