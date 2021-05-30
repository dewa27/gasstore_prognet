<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GAS - Toko Online Motor Tua Terpercaya Sejak 1916</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/bootstrap.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Modernizr JS -->
    <!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/39d07dc006.js" crossorigin="anonymous"></script>
    <!-- Animate.css -->
    <!-- <link rel="stylesheet" href="/css/animate.css"> -->
    <!-- Bootstrap  -->
    @yield('head')
    <style>
        .container-absolute {
            position: absolute;
            top: 2%;
            left: 50%;
            width: 30%;
            transform: translate(-50%, 0);
        }

        .dropdown-container {
            position: relative;
        }

        .dropdown-nav {
            /* background: black; */
            text-align: left !important;
            display: none;
            position: absolute;
            top: 60% !important;
            left: 0% !important;
        }

        .dropdown-nav li a {
            line-height: 15px !important;
        }


        .blackid {
            background-color: black;
        }

        .fas {
            color: #EA272D;
        }

        .fa-bell {
            color: #EA272D !important;
        }

        .button-notify {
            padding: 0;
            border: none;
            background: none;
            cursor: pointer !important;
        }

        .button-notify:focus {
            outline: none;
            color: white;
        }

        .notif-box {
            position: absolute !important;
            top: 80%;
            z-index: 1;
            overflow: auto;
            max-height: 300px;
            display: none;
        }

        .notif-item:hover {
            filter: brightness(150%) !important;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <!-- <div class="top-menu"> -->
            <div class="container h-100">
                <div class="row my-auto">
                    <div style="right:18%;" class="w-50 notif-box navpopup-menu">
                        <div style="background-color:black;" class="card px-2 py-2">
                            <form id="notifForm" action="notifikasi/baca" method="POST">
                                @csrf
                                <input id="trans_id" type="hidden" name="transaction_id">
                                <input id="response_id" type="hidden" name="response_id">
                                <input id="notif_id" type="hidden" name="notification_id">
                                <input id="product_id" type="hidden" name="product_id">
                                <h5 class="text-center text-light">Notifikasi</h5>
                                @if(isset($notif))
                                @if($notif->count()==0)
                                <p class="text-center text-light">Tidak ada Notifikasi</p>
                                @else
                                @foreach ($notif as $item)
                                @if($item->data['type']=="transaction")
                                <div style="background:rgba(56, 59, 57, 0.4) !important"
                                    data-notif-type="{{$item->data['type']}}" data-notif="{{$item->id}}"
                                    id="{{$item->data['type']=="transaction" ? $item->data['transaction_id'] : $item->data['response_id']}}"
                                    class="card my-1 p-2 notif-item">
                                    <p class="mb-0 text-light">{{$item->data['message']}}</p>
                                    @foreach (\App\Transaction::find($item->data['transaction_id'])->detail_transaksi as
                                    $product)
                                    <p class="mb-0" style="font-size:14px">
                                        {{-- <p>Budhi</p> --}}
                                        {{\App\Product::find($product->product_id)->product_name}} - {{$product->qty}}
                                    </p>
                                    @endforeach
                                    <p style="font-size:14px;" class="mt-2 mb-0 text-light">Status Transaksi :
                                        {{$item->data['status']}}</p>
                                    <p class="mb-0 text-right text-light" style="font-size:14px;">
                                        {{$item->created_at->diffForHumans()}}</p>
                                </div>
                                @else
                                <div style="background:rgba(56, 59, 57, 0.4) !important"
                                    data-notif-type="{{$item->data['type']}}" data-notif="{{$item->id}}"
                                    id="{{$item->data['response_id']}}" class="card my-1 p-2 notif-item">
                                    <p class="mb-0 text-light">Admin membalas reviewmu!</p>
                                    <p class="mb-0 text-light">{{$item->data['message']}}</p>
                                    <p class="mb-0 text-right text-light" style="font-size:14px;">
                                        {{$item->created_at->diffForHumans()}}</p>
                                </div>
                                @endif
                                @endforeach
                                @endif
                                @else
                                <p class="text-center text-light">Tidak ada Notifikasi</p>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-2 text-center logo-wrap">
                        <a href=""><img class="logo" src="/images/logo.png" alt=""></a>
                        <!-- <div id="fh5co-logo"><a href="index.html"></a></div> -->
                    </div>

                    <div class="col-md-6 menu-1 menu-wrap">
                        <ul>
                            <li class="{{request()->is('/') ? 'active':''}}"><a href="/">Home</a></li>
                            <li class="{{request()->is('products') ? 'active':''}}">
                                <a href="/products">Produk</a>
                            </li>
                            <li><a href="about.html">Tentang Kami</a></li>
                        </ul>
                    </div>
                    @if(Illuminate\Support\Facades\Auth::guard('web')->check())
                    <div class="col-md-4 text-center menu-1 menu-wrap d-flex justify-content-end">
                        <ul class="mr-4">
                            <div class="dropdown-container position-relative">
                                <ul class="mt-0">

                                    <li class="akun mr-2"><a href="">{{Auth::user()->name}}<i
                                                class="ml-1 fa fa-caret-down"></i></a></li>
                                    <li style="font-size:12px;" class="breadcrumb-item"><button class="button-notify"><i
                                                class="fas fa-lg fa-bell"></i></button></li>
                                    </li>
                                </ul>
                                <ul class="dropdown-nav navpopup-menu">
                                    <li class="p-0"><a class="py-0 m-0" href="/edit/profile">Pengaturan</a></li>
                                    <li class="p-0"><a class="py-0 m-0" href="/pembelian">Transaksi</a></li>
                                    <li class="p-0"><a class="py-0 m-0" href="" onclick="event.preventDefault();
                                    document.getElementById('frm-logout').submit();">Logout</a>
                                    </li>
                                    <form id="frm-logout" action="{{ route('user.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </ul>
                        <ul class="">
                            <li><a href="/cart"><i class="fas fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    @else
                    <div class="col-md-4 text-center menu-1 menu-wrap d-flex justify-content-end">
                        <ul>
                            <li><a href="/login">Login / Signup</a></li>
                            {{-- <li><a href="/cart"><i class="fas fa-shopping-cart"></i></a></li> --}}
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <!-- </div> -->
        </nav>
        @yield('content')
        <div class="container-absolute">
            @if(Session::has('flash'))
            <div class="alert alert-success">
                <p class="msg text-dark text-center"> {{ Session::get('flash') }}</p>
            </div>
            @endif

        </div>
        <footer id="fh5co-footer" role="contentinfo" class="fh5co-section">
            <div class="container">
                <div class="row row-pb-md">
                    <div class="col-md-4 fh5co-widget">
                        <h4>Tasty</h4>
                        <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta
                            adipisci architecto culpa amet.</p>
                    </div>
                    <div class="col-md-2 col-md-push-1 fh5co-widget">
                        <h4>Links</h4>
                        <ul class="fh5co-footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Gallery</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-md-push-1 fh5co-widget">
                        <h4>Categories</h4>
                        <ul class="fh5co-footer-links">
                            <li><a href="#">Landing Page</a></li>
                            <li><a href="#">Real Estate</a></li>
                            <li><a href="#">Personal</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">e-Commerce</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-md-push-1 fh5co-widget">
                        <h4>Contact Information</h4>
                        <ul class="fh5co-footer-links">
                            <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li>
                            <li><a href="tel://1234567920">+ 1235 2355 98</a></li>
                            <li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                            <li><a href="http://https://freehtml5.co">freehtml5.co</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
    </div>

    <!-- jQuery -->
    <script src="/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- Waypoints -->
    <script src="/js/jquery.waypoints.min.js"></script>
    <!-- Waypoints -->
    <script src="/js/jquery.stellar.min.js"></script>
    <!-- Flexslider -->
    <script src="/js/jquery.flexslider-min.js"></script>
    <!-- Main -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
        integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" />
    @yield('script')
    <script>
        setTimeout(function(){
            $(".container-absolute").remove();
        }, 3500 ); // 3.5secs
        $('.akun').click(function(e){
            e.preventDefault();
            $('.navpopup-menu').hide();
            $(".dropdown-nav").toggle();
        });
        $('.button-notify').click(function(){
            $('.navpopup-menu').hide();
            $('.notif-box').toggle();
        });
        $('.notif-item').click(function(){
            if($(this).attr('data-notif-type')=="transaction"){
                $('#trans_id').val($(this).attr('id'));
                $('#notif_id').val($(this).attr('data-notif'));
            }else{
                $('#notif_id').val($(this).attr('data-notif'));
                $('#response_id').val($(this).attr('id'));
            }
            $('#notifForm').submit();
        });
        $(document).mouseup(function(e) {
            var container = $(".navpopup-menu");
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                container.hide();
            }
        });
    </script>
</body>

</html>