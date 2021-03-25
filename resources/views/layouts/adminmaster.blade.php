<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/add.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/39d07dc006.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.js"></script>
    {{-- <script src="/js/bootstrap.min.js"></script> --}}
    <!-- <link rel="stylesheet" href='css/bootstrap.min.css'> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
        integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" />
    <style>
        .profile {
            width: 45px !important;
            height: 45px !important;
            object-fit: cover !important;
        }

        .icon-container {
            width: 30px !important;
        }
    </style>
    @yield('head')
</head>

<body>
    <div class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/admin/products" class="brand-link text-center">
                    <span class="brand-text font-weight-light">Toko Dewa Prognet 6</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mb-3 py-2 d-flex justify-content-between align-items-center">
                        <div class="info">
                            <a href="" class="d-block">Dewa 19</a>
                        </div>
                        <img src="{{asset('images/foto-himpunan.jpg')}}" class="d-block profile rounded-circle" alt="X">

                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview {{request()->is('admin/products') ? 'menu-open':''}}">
                                <a href="/admin/products" class="nav-link">
                                    <div class="icon-container d-inline-block">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <p>
                                        Produk
                                    </p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                    <li class="nav-item {{request()->is('admin/categories') ? 'menu-open':''}}">
                                <a href="/admin/categories" class="nav-link">
                                    <div class="icon-container d-inline-block">
                                        <i class="far fa-circle nav-icon"></i>

                                    </div>
                                    <p>
                                        Kategori
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item {{request()->is('admin/discounts') ? 'menu-open':''}}">
                                <a href="/admin/discounts" class="nav-link">
                                    <div class="icon-container d-inline-block">
                                        <i class="far fa-circle nav-icon"></i>

                                    </div>
                                    <p>
                                        Diskon
                                    </p>
                                </a>
                            </li>
                        </ul> --}}
                        </li>
                        <li class="nav-item {{request()->is('admin/categories') ? 'menu-open':''}}">
                            <a href="/admin/categories" class="nav-link">
                                <div class="icon-container d-inline-block">
                                    <i class="fas fa-list"></i>
                                </div>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('admin/couriers') ? 'menu-open':''}}">
                            <a href="/admin/couriers" class="nav-link">
                                <div class="icon-container d-inline-block">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <p>
                                    Kurir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('admin/discounts') ? 'menu-open':''}}">
                            <a href="/admin/discounts" class="nav-link">
                                <div class="icon-container d-inline-block">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <p>
                                    Diskon
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('admin/transactions') ? 'menu-open':''}}">
                            <a href="/admin/transactions" class="nav-link">
                                <div class="icon-container d-inline-block">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <p>
                                    Transaksi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('admin/users') ? 'menu-open':''}}">
                            <a href="/admin/users" class="nav-link">
                                <div class="icon-container d-inline-block">
                                    <i class="fas fa-user"></i>
                                </div>
                                <p>
                                    Pengguna
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                                <a href="pages/widgets.html" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li> -->
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><i class="fas fa-lg fa-bell"></i></li>
                                    <li class="breadcrumb-item"><a href="#">Logout</a></li>
                                    {{-- <li class="breadcrumb-item active">Dashboard v1</li> --}}
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <!-- /.content-wrapper -->
        </div>
    </div>
</body>
<script>
    $('.has-treeview').click(function(){
    if($(this).hasClass('menu-open')){
        $(this).removeClass('menu-open');
    }
    else{
        $(this).addClass('menu-open');
    }
    })
</script>
@yield('script')

</html>