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
</head>

<body>

    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <!-- <div class="top-menu"> -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center logo-wrap">
                        <a href=""><img class="logo" src="/images/logo.png" alt=""></a>
                        <!-- <div id="fh5co-logo"><a href="index.html"></a></div> -->
                    </div>

                    <div class="text-center menu-1 menu-wrap">
                        <ul>
                            <li class="{{request()->is('/') ? 'active':''}}"><a href="/">Home</a></li>
                            <!-- <li><a href="menu.html">Menu</a></li> -->
                            {{-- <li class="has-dropdown"> --}}
                            <li class="{{request()->is('products') ? 'active':''}}">
                                <a href="/products">Produk</a>
                                <!-- <ul class="dropdown">
									<li><a href="#">Events</a></li>
									<li><a href="#">Food</a></li>
									<li><a href="#">Coffees</a></li>
								</ul> -->
                            </li>
                            <!-- <li><a href="reservation.html">Reservation</a></li> -->
                            <li><a href="about.html">Tentang Kami</a></li>
                            <!-- <li><a href="contact.html">Contact</a></li> -->
                        </ul>
                    </div>
                    <div class="text-center menu-1 menu-wrap margin-add">
                        <ul>
                            <li><a href="index.html">Login / Signup</a></li>
                            <li><a href="index.html"><i class="fas fa-shopping-cart"></i></a></a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- </div> -->
        </nav>
        @yield('content')
        <!-- <div id="fh5co-slider" class="fh5co-section animate-box">
			<div class="container">
				<div class="row">
					<div class="col-md-6 animate-box">
						<div class="fh5co-heading">
							<h2>Our Best <em>&amp;</em> Unique Menu</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis sit itaque totam, a maiores nihil, nulla magnam porro minima officiis!</p>
						</div>
					</div>
					<div class="col-md-6 col-md-push-1 animate-box">
						<aside id="fh5co-slider-wrwap">
							<div class="flexslider">
								<ul class="slides">
									<li style="background-image: url(images/gallery_7.jpeg);">
										<div class="overlay-gradient"></div>
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 col-md-offset-0 col-md-pull-10 slider-text slider-text-bg">
													<div class="slider-text-inner">
														<div class="desc">
															<h2>Crab <em>with</em> Curry Sources</h2>
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt eveniet quae, numquam magnam doloribus eligendi ratione rem, consequatur quos natus voluptates est totam magni! Nobis a temporibus, ipsum repudiandae dolorum.</p>
															<p><a href="#" class="btn btn-primary btn-outline">Learn More</a></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li style="background-image: url(images/gallery_6.jpeg);">
										<div class="overlay-gradient"></div>
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 col-md-offset-0 col-md-pull-10 slider-text slider-text-bg">
													<div class="slider-text-inner">
														<div class="desc">
															<h2>Tuna <em>&amp;</em> Roast Beef</h2>
															<p>Ink is a free html5 bootstrap and a multi-purpose template perfect for any type of websites. A combination of a minimal and modern design template. The features are big slider on homepage, smooth animation, product listing and many more</p>
															<p><a href="#" class="btn btn-primary btn-outline">Learn More</a></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li style="background-image: url(images/gallery_5.jpeg);">
										<div class="overlay-gradient"></div>
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 col-md-offset-0 col-md-pull-10 slider-text slider-text-bg">
													<div class="slider-text-inner">
														<div class="desc">
															<h2>Egg <em>with</em> Mushroom</h2>
															<p>Ink is a free html5 bootstrap and a multi-purpose template perfect for any type of websites. A combination of a minimal and modern design template. The features are big slider on homepage, smooth animation, product listing and many more</p>
															<p><a href="#" class="btn btn-primary btn-outline">Learn More</a></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div> -->

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
</body>

</html>