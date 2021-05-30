@extends('layouts.master')
@section('head')
<style>
	/* .flex-caption {
		padding: 0 30px;
		width: 100%;
		background: rgba(0, 0, 0, .5);
		color: #fff !important;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, .3);
		font-size: 14px;
		line-height: 18px;
		margin-bottom: 0;
	} */
	.img__wrap {
		position: relative;
	}

	.img__description {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: #000;
		color: #fff;
		visibility: hidden;
		opacity: 0;
		/* transition effect. not necessary */
		/* transition: opacity .2s, visibility .2s; */
	}

	.img__wrap:hover .img__description {
		visibility: visible;
		opacity: 0.6;
	}

	.mid-text {
		overflow: hidden;
		text-align: center;
	}

	.mid-text:before,
	.mid-text:after {
		background-color: #EA272D;
		content: "";
		display: inline-block;
		height: 2px;
		position: relative;
		vertical-align: middle;
		width: 50%;
	}

	.mid-text:before {
		right: 0.5em;
		margin-left: -50%;
	}

	.mid-text:after {
		left: 0.5em;
		margin-right: -50%;
	}

	p {
		color: white !important;
	}
</style>
@endsection
@section('content')
<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner"
	style="background-image: url(/images/heroo.jpg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="display-t js-fullheight">
					<div class="display-tc js-fullheight">
						<h1 data-aos="fade-up" data-aos-duration="1000">Toko Motor Tua Terpercaya Sejak 1916</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- <div id="fh5co-about" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div data-aos="fade-right" data-aos-once="true" data-aos-duration="1000" class="col-md-6 col-md-pull-4 img-wrap animate-box">
				<img src=" /images/hero_1.jpeg" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
			</div>
			<div data-aos="fade-left" data-aos-once="true" data-aos-duration="1000" class="col-md-5 col-md-push-1 animate-box">
				<div class="section-heading">
					<h2>Old but Gold</h2>
					<p>Barang-barang lama memang sudah menua. Tak sekuat sebelumnya, tapi yang terbaik sepanjang masa</p>
					<p><a href="#" class="btn btn-primary btn-outline">Cek Koleksi</a></p>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div id="fh5co-featured-menu" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 fh5co-heading">
				<h2 class="mid-text">Old but Gold</h2>
				<div class="row">
					<div class="col-md-6">
						<p>Koleksi tua terbaik berkualitas tinggi</p>
					</div>
				</div>
			</div>
			<div class="col-md-10 mx-auto">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="img__wrap">
								<a class="p-0 m-0" href="/products"><img class="p-0 m-0 img-slider"
										src="/images/heroo.jpg" /></a>
								<div class="img__description p-3 m-0">
									<a href="/products">Produk</a>
									<p class="text-center">Penjelasan Produk</p>
									<p class="text-center">Penjelasan Produk</p>
								</div>
							</div>
						</li>
						<li>
							<div class="img__wrap">
								<a class="p-0 m-0" href="/products"><img class="p-0 m-0 img-slider"
										src="/images/heroo.jpg" /></a>
								<div class="img__description p-3 m-0">
									<a href="/products">Produk</a>
									<p class="text-center">Penjelasan Produk</p>
									<p class="text-center">Penjelasan Produk</p>
								</div>
							</div>

						</li>
						<li>
							<div class="img__wrap">
								<a class="p-0 m-0" href="/products"><img class="p-0 m-0 img-slider"
										src="/images/heroo.jpg" /></a>
								<div class="img__description p-3 m-0">
									<a href="/products">Produk</a>
									<p class="text-center">Penjelasan Produk</p>
									<p class="text-center">Penjelasan Produk</p>
								</div>
							</div>
						</li>
						<li>
							<div class="img__wrap">
								<a class="p-0 m-0" href="/products"><img class="p-0 m-0 img-slider"
										src="/images/heroo.jpg" /></a>
								<div class="img__description p-3 m-0">
									<a href="/products">Produk</a>
									<p class="text-center">Penjelasan Produk</p>
									<p class="text-center">Penjelasan Produk</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box">
				<div class="fh5co-item">
					<img src="/images/heroo.jpg" class="img-responsive" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
					<h3>Bake Potato Pizza</h3>
					<span class="fh5co-price">$20<sup>.50</sup></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box">
				<div class="fh5co-item margin_top">
					<img src="/images/gallery_8.jpeg" class="img-responsive" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
					<h3>Salted Fried Chicken</h3>
					<span class="fh5co-price">$19<sup>.00</sup></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
				</div>
			</div>
			<div class="clearfix visible-sm-block visible-xs-block"></div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box">
				<div class="fh5co-item">
					<img src="/images/gallery_7.jpeg" class="img-responsive" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
					<h3>Italian Sauce Mushroom</h3>
					<span class="fh5co-price">$17<sup>.99</sup></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box">
				<div class="fh5co-item margin_top">
					<img src="/images/gallery_6.jpeg" class="img-responsive" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
					<h3>Fried Potato w/ Garlic</h3>
					<span class="fh5co-price">$22<sup>.50</sup></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
				</div>
			</div>
		</div> -->
		</div>
	</div>

	<div id="fh5co-featured-testimony" class="fh5co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 fh5co-heading animate-box">
					<h2>Testimony</h2>
					<div class="row">
						<div class="col-md-6">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis sit
								itaque totam, a maiores nihil, nulla magnam porro minima officiis! Doloribus aliquam
								voluptates corporis et tempora consequuntur ipsam, itaque, nesciunt similique commodi
								omnis.</p>
						</div>
					</div>
				</div>

				<div class="col-md-5 animate-box img-to-responsive animate-box" data-animate-effect="fadeInLeft">
					<img src="/images/person_1.jpg" alt="">
				</div>
				<div class="col-md-7 animate-box" data-animate-effect="fadeInRight">
					<blockquote>
						<p> &ldquo; Quantum ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis
							sit itaque totam, a maiores nihil, nulla magnam porro minima officiis! Doloribus aliquam
							voluptates corporis et tempora consequuntur ipsam. &rdquo;</p>
						<p class="author"><cite>&mdash; Jane Smith</cite></p>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('script')
	<script>
		$(window).load(function() {
			AOS.init();
			$('.flexslider').flexslider({
				animation: "slide"
			});
		});
	</script>
	@endsection