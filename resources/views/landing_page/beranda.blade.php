@extends('landing_page.layout')

@section('layout')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 text-start">
            <h1 class="fw-bold mb-3">Selamat Datang</h1>
            <p class="fs-5 text-muted">Perkenalkan kami dari <strong>Katering Feast & Festivity</strong></p>
            <h2 class="mt-4 mb-3 fw-bold">Hidangan Lezat, Langsung ke Rumah Anda</h2>
            <p class="fs-5 text-muted">Nikmati kelezatan masakan rumah berkualitas restoran, diantar langsung ke lokasi Anda. 
                Kami menghadirkan pengalaman bersantap istimewa untuk setiap momen spesial Anda.
            </p>
            <div class="mt-4">
                <a href="https://wa.me/+628123456789" target="_blank" class="btn btn-success btn-lg px-5">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('cuba/assets/images/logo/tes.png') }}" class="img-fluid rounded w-75">
        </div>
    </div>
</div>
@endsection
