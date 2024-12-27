<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restawrant — Harga Kaki Lima Rasa Kaki Lima!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4d516d4246.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-white d-block d-sm-block d-md-block d-lg-none py-3 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">🍣 Restawrant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">
                        🍣 Restawrant
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="margin-top: -24px">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <hr />
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('user.beranda') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.about') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.kategori') }}">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.menu') }}">Menu</a>
                        </li>
                    </ul>
                    <hr />
                    <div class="d-grid gap-2">
                        <a href="{{ route('login') }}" class="btn btn-warning text-white me-2 px-5 fw-500">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-warning text-white me-2 px-5 fw-500">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="py-1 bg-white border-bottom d-none d-sm-none d-md-none d-lg-block text-grey">
        <div class="container d-flex flex-wrap fs-15">
            <ul class="nav me-auto">
                <li class="nav-item me-2">
                    <a href="{{ route('user.beranda') }}" class="nav-link link-dark text-grey px-2 active" aria-current="page">Beranda</a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('user.about') }}" class="nav-link link-dark text-grey px-2">Tentang Kami</a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('user.kategori') }}" class="nav-link link-dark text-grey px-2">Kategori</a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('user.menu') }}" class="nav-link link-dark text-grey px-2">Menu</a>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link link-dark text-grey px-2 no-effect-hover">Nomor Telepon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark text-grey px-2 no-effect-hover">|</a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/+628123456789" class="nav-link link-dark text-grey px-2" target="_blank">+628123456789</a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/+628987654321" target="_blank" class="nav-link link-dark text-grey px-2">+628987654321</a>
                </li>
            </ul>
        </div>
    </nav>

    <header class="py-3 mb-4 border-bottom d-none d-sm-none d-md-none d-lg-block bg-white sticky-top">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <span class="fs-3 fw-bold">🍣 Feast & Festivity</span>
            </a>
            <a href="{{ route('login') }}" class="btn btn-warning text-white me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-warning text-white me-2">Register</a>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('layout')
        </div>
    </main>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>
</html>