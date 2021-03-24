@extends('layouts.master')
@section('head')
<style>
	p,
	h2 {
		color: #fff !important;
	}


	.owl-prev,
	.owl-next {
		width: 15px;
		height: 100px;
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		display: block !important;
		border: 0px solid black;
	}

	.owl-prev,
	.owl-next span {
		font-size: 2rem !important;
	}

	.owl-prev {
		left: -20px;
	}

	.owl-next {
		right: -20px;
	}

	.owl-prev i,
	.owl-next i {
		transform: scale(2, 5);
		color: #ccc;
	}

	.img-carousel {
		max-height: 650px;
		object-fit: cover;
	}

	.quantity-custom,
	.quantity-custom:focus {
		text-align: end;
		width: 100px;
		float: right;
		background: transparent;
		color: white;
		outline: none;
		border: 0;
		appearance: none;
		padding-bottom: 5px;
	}

	.main-img {
		width: 100%;
		max-height: 500px;
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

	#btm_carousel {
		height: 300px;
	}

	.card-crop {
		height: 200px !important;
		object-fit: cover !important;
	}

	.card-style {
		/* background: transparent; */
		background: rgba(56, 59, 57, 0.4) !important;
	}

	.discount-label {
		position: absolute;
		top: 0;
		right: 0;
		width: 0;
		height: 0;
		border-top: 60px solid #EA272D;
		border-left: 60px solid transparent;
		opacity: 0.7;
	}

	.discount-text {
		color: #fff !important;
		position: absolute;
		top: 0;
		right: 5px;
	}

	.review-container {
		overflow: auto;
		height: 400px;
	}

	.card-crop {
		height: 200px !important;
		object-fit: cover;
	}

	.card-style {
		/* background: transparent; */
		background: rgba(56, 59, 57, 0.4) !important;
	}

	.card-subtitle {
		color: #F3A3A3 !important;
	}

	.star-icon {
		color: rgb(234, 39, 45);
	}

	.input-number {
		font-size: 14px;
		border: none;
		outline: none;
		background: transparent !important;
		min-width: 0 !important;
		max-width: 50px !important;
	}

	.input-number::-webkit-outer-spin-button,
	.input-number::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
</style>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
	integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
	crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection
@section('content')
<div id="fh5co-featured-menu" class="fh5co-section py-0">
	<div id="fh5co-about" class="fh5co-section">
		<div class="container">
			<div class="row px-3">
				<div class="col-md-7">
					<div class="mb-4">
						@if (is_null($product->images->first()))
						<img class="main-img img-responsive" src="{{asset('images/products/null.png')}}"
							alt="First slide">
						@else
						<img class="main-img img-responsive"
							src="{{asset('images/products/'.$product->images->first()->image_name)}}" alt="First slide">
						@endif
					</div>
					<div id="main_carousel" class="owl-carousel owl-theme mx-auto w-100" data-slider-id="1">
						@if(count($product->images)==1)
						@else
						@foreach ($product->images as $img)
						<div class="item px-3 img-carousel"> <img class=""
								src="{{asset('images/products/'.$img->image_name)}}" alt="First slide">
						</div>
						@endforeach
						@endif
					</div>
				</div>
				<div class="col-md-5">
					<h2 class="text-center">Motor</h2>
					<div style="min-height:200px;">
						<p class="mb-3 px-3">{{$product->description}}</p>
					</div>
					<p class="font-weight-bold border-bottom border-danger my-3">Harga <span
							class="float-right font-weight-light">{{$product->price}}</span></p>
					{{-- <p class="font-weight-bold border-bottom border-danger my-3">Jumlah<span><input placeholder="0"
								class="quantity-custom" min="1" type="number"></span></p> --}}
					<div class="border-bottom border-danger my-3">
						<div class="input-group d-flex justify-content-center align-items-center">
							<p style="flex-basis:55%;" class="font-weight-bold my-3">Jumlah Produk</p>
							<span style="flex-basis:10%;" class="input-group-btn">
								<button type="button" class="quantity-left-minus btn bg-transparent btn-number"
									data-type="minus" data-field="">
									<i class="fas fa-minus text-light"></i>
									{{-- <span class="glyphicon glyphicon-minus"></span> --}}
								</button>
							</span>
							<input style="flex-basis:25%" type="number" id="quantity" name="quantity"
								class="form-control p-0 text-light input-number d-inline-block text-center" value="1"
								min="1" max="100">
							<span style="flex-basis:10%;" class="input-group-btn">
								<button type="button" class="quantity-right-plus btn bg-transparent btn-number"
									data-type="plus" data-field="">
									<i class="fas fa-plus text-light"></i>
									{{-- <span class="glyphicon glyphicon-plus"></span> --}}
								</button>
							</span>
						</div>
					</div>
					<a href="#" class="d-block mb-2 mx-auto btn btn-hovered">Beli Langsung</a>
					<a href="#" class="d-block mx-auto btn btn-hovered">Tambahkan ke Keranjang</a>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-12">
					<h2 class="mid-text">Ulasan Produk</h2>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-7 review-container">
							<div class="card card-style mb-2">
								<div class="card-body">
									<h3 class="mb-0" style="color:#EA272D;">Dewa Krishna</h3>
									<p class="mb-0">*****</p>
									<p class="mb-0">Produknya bagus tapi kok saya gak dikirim-kirim</p>
								</div>
							</div>
							<div class="card card-style mb-2">
								<div class="card-body">
									<h3 class="mb-0" style="color:#EA272D;">Dewa Krishna</h3>
									<p class="mb-0">*****</p>
									<p class="mb-0">Produknya bagus tapi kok saya gak dikirim-kirim</p>
								</div>
							</div>
							<div class="card card-style mb-2">
								<div class="card-body">
									<h3 class="mb-0" style="color:#EA272D;">Dewa Krishna</h3>
									<p class="mb-0">*****</p>
									<p class="mb-0">Produknya bagus tapi kok saya gak dikirim-kirim</p>
								</div>
							</div>
							<div class="card card-style mb-2">
								<div class="card-body">
									<h3 class="mb-0" style="color:#EA272D;">Dewa Krishna</h3>
									<p class="mb-0">*****</p>
									<p class="mb-0">Produknya bagus tapi kok saya gak dikirim-kirim</p>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="d-flex justify-content-center align-items-center">
								<i style="background: rgb(234, 39, 45);background: linear-gradient(90deg, rgba(234, 39, 45, 1) {{$product->product_rate*20}}%, rgba(3, 3, 3, 0.4)  {{$product->product_rate*20}}%);
								-webkit-background-clip: text;
								-webkit-text-fill-color: transparent;" class="mr-5 fas fa-6x fa-star"></i>
								<p class="pb-4 mb-0" style="font-size:90px;">{{$product->product_rate}}</p>
							</div>
							<div><canvas id="myChart"></canvas></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-12">
					<h2 class="mid-text">Produk Serupa</h2>
				</div>
				<div class="col-md-12">
					<div id="btm_carousel" class="owl-carousel owl-theme mx-auto w-100" data-slider-id="1">
						@foreach($similar_products as $itemArr)
						<div class="item d-flex">
							@foreach($itemArr as $item)
							<div style="height:400px;" class="card card-style w-25 mx-2">
								<div>
									<div class="position-relative">
										@if (is_null($item->images->first()))
										<a href="/products/{{$item->id}}/detail"><img class="card-img-top card-crop"
												src="/images/products/null.png" alt="Tidak ada gambar"></a>
										@else
										<a href="/products/{{$item->id}}/detail"><img class="card-img-top card-crop"
												src="/images/products/{{$item->images->first()->image_name}}"
												alt="Tidak ada gambar"></a>
										@endif
										<div class="discount-label"></div>
										<p class="discount-text">30%</p>
									</div>
								</div>
								{{-- @if(is_null($item->images->first()))
								<img class="card-img-top card-crop" src="{{asset('images/products/null.png')}}"
								alt="Card image cap">
								@else
								<img class="card-img-top card-crop"
									src="{{asset('images/products/'.$item->images->first()->image_name)}}"
									alt="Card image cap">
								@endif --}}
								<div class="card-body">
									<h5 class="card-title font-weight-bold text-light">{{$item->product_name}}</h5>
									<p class="card-text text-light">{{$item->description}}</p>
									<a href="#" class="btn btn-primary">Beli Langsung</a>
								</div>
							</div>
							@endforeach
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
	integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
	crossorigin="anonymous"></script>
<script>
	$(function() {
				var quantitiy=0;
		$('.quantity-right-plus').click(function(e){
				
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());
				
				// If is not undefined
					
					$('#quantity').val(quantity + 1);

				
					// Increment
				
			});

			$('.quantity-left-minus').click(function(e){
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());
				
				// If is not undefined
			
					// Increment
					if(quantity>0){
					$('#quantity').val(quantity - 1);
					}
			});
		$(".btn-hovered").hover(function() {
			$(this).addClass("btn-primary");
		}, function() {
			$(this).removeClass("btn-primary");
		});
		let carousel=$('#main_carousel');
        carousel.owlCarousel({
			nav:true,
            items:2,
			loop:true,
			center:true,
            // autoHeight:true,
        });
		carousel.on('change.owl.carousel', function(event) {
			setTimeout(function() {
				let img=$('.main-img');
				let centerImage=$('.center img').attr("src");
				console.log(centerImage);
				img.fadeOut('fast', function () {
					img.attr('src', centerImage);
					img.fadeIn('fast');
				});
			},20);
		});
		let btm_carousel=$('#btm_carousel');
		btm_carousel.owlCarousel({
			nav:true,
			center:true,
			items:1,
            // autoHeight:true,
        });
		var ctx = document.getElementById('myChart').getContext('2d');
		var myBarChart = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: ["5","4", "3", "2", "1"],
				datasets: [
					{
					backgroundColor: ["#EA272D","#EA272D","#EA272D","#EA272D","#EA272D"],
					data: [1,1,3,2,1]
					}
				]
			},
			options: {
				legend: {
					display: false,
				},
		        scales: {
					xAxes: [{
						ticks: {
							suggestedMin: 0,
                    		suggestedMax: 25,
							stepSize:5
						}
					}]
				}
			}
		});
        // $('#carouselExampleIndicators').carousel();
		// $('.selectpicker').selectpicker({
		// 	noneSelectedText: 'Pilih Kategori',
		// 	size: '4',
		// 	// virtualScroll: '2',
		// });
		// $(".btn-hovered").hover(function() {
		// 	$(this).addClass("btn-primary");
		// }, function() {
		// 	$(this).removeClass("btn-primary");
		// });
		// $(".fa-stack-1x").hover(function() {
		// 	$('.fa-stack-2x').removeClass("icon-background");
		// }, function() {
		// 	$('.fa-stack-2x').addClass("icon-background");
		// });
	});
</script>
@endsection