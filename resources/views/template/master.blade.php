<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/icofont.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/themify.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('cuba') }}/assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/select2.css">
</head>
<body onload="startTime()">
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper">
                    <div class="logo-wrapper"><a href=""><img class="img-fluid" src="{{ asset('cuba') }}/assets/images/logo/logo.png" alt=""></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="sliders"></i></div>
                </div>
                <div class="left-header col horizontal-wrapper pl-0">
                    <ul class="horizontal-menu">
                        <li class="mega-menu outside">
                            @if (Auth::guard('user')->check())
                            <a class="nav-link" href="{{ route('pesanan-create') }}"><i data-feather="layers"></i><span>Buat Pesanan</span></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="nav-right col-8 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li><div class="mode"><i class="fa fa-moon-o"></i></div></li>
                        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 mr-0">
                            <div class="media profile-media"><img class="b-r-10" src="{{ asset('cuba') }}/assets/images/dashboard/profile.jpg" alt="">
                                <div class="media-body">
                                    @if (Auth::guard('customer')->check())
                                        <span>{{ Auth::guard('customer')->user()->nama }}</span>
                                    @elseif (Auth::guard('user')->check())
                                        <span>{{ Auth::guard('user')->user()->name }}</span>
                                    @endif
                                    <p class="mb-0 font-roboto">Lainnya <i class="middle fa fa-angle-down"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                                <li><a href="{{ route('logout-process') }}"><i data-feather="log-in"> </i><span>Log out</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-body-wrapper sidebar-icon">
            <div class="sidebar-wrapper">
                <div class="logo-wrapper">
                    <a href="" style="text-decoration: none; display: inline-block;">
                        <span style="font-family: 'Rubik', sans-serif; font-weight: 700; font-size: 19px; color: #0a5bac;">
                            Feast & Festivity
                        </span>
                    </a>
                    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
                </div>
                <div class="logo-icon-wrapper"><a href=""><img class="img-fluid" src="{{ asset('cuba') }}/assets/images/logo/logo-icon.png" alt=""></a></div>
                <nav class="sidebar-main">
                    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                    <div id="sidebar-menu">
                        <ul class="sidebar-links custom-scrollbar">
                            <li class="back-btn"><a href=""><img class="img-fluid" src="{{ asset('cuba') }}/assets/images/logo/logo-icon.png" alt=""></a>
                                <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                            </li>
                            
                            @if(Auth::guard('customer')->check())
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('frontend-buat_pesanan') }}">
                                        <i data-feather="folder-plus"> </i><span>Buat Pesanan</span>
                                    </a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('frontend-keranjangBelanja') }}">
                                        <i data-feather="shopping-cart"> </i><span>Keranjang Belanja</span>
                                    </a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('frontend-daftar_pesananUser') }}">
                                        <i data-feather="shopping-bag"> </i><span>Daftar Pesanan</span>
                                    </a>
                                </li>
                            @endif
                                
                            @if(Auth::guard('user')->check())
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
                                        <i data-feather="home"> </i><span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="#"><i data-feather="shopping-cart">
                                        </i><span>Manage Pesanan</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('order.indexMenungguJadwal') }}">Menunggu Jadwal</a></li>
                                        <li><a href="{{ route('order.indexPesananDibuat') }}">Pesanan Dibuat</a></li>
                                        <li><a href="{{ route('order.indexPesananSelesai') }}">Pesanan Selesai</a></li>
                                        <li><a href="{{ route('order.indexPesananDiantar') }}">Pesanan Diantar</a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('pelanggan-index') }}">
                                        <i data-feather="users"> </i><span>Customer</span>
                                    </a>
                                </li>
                                <hr>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="#"><i data-feather="airplay">
                                        </i><span>Manage Menu</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('kategori-index') }}">Categories</a></li>
                                        <li><a href="{{ route('produk-index') }}">Products</a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="#"><i data-feather="award">
                                        </i><span>Karyawan & Gaji</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('karyawan-index') }}">Eployee</a></li>
                                        <li><a href="{{ route('gaji-index') }}">Salary</a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('pengeluaran-index') }}">
                                        <i data-feather="edit"> </i><span>Expense Report</span>
                                    </a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('laporan_penjualan-index') }}">
                                        <i data-feather="layers"> </i><span>Sales Report</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </nav>
            </div>
            
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('cuba') }}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/bootstrap/bootstrap.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/config.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/tooltip-init.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/script.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{ asset('cuba') }}/assets/js/select2/select2-custom.js"></script>
</body>
</html>