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
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body"><span class="m-0">Pesanan Selesai</span>
                            <h4 class="mb-0 counter">{{ $totalOrderSelesai }}</h4><i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-success b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body"><span class="m-0">Penjualan</span>
                            <h4 class="mb-0 counter">Rp {{ number_format($totalHargaSelesai, 0, ',', '.') }}</h4><i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-danger b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body"><span class="m-0">Pengeluaran</span>
                            <h4 class="mb-0 counter">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4><i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection