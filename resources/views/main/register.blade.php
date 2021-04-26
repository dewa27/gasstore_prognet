@extends('layouts.master')
@section('head')
<style>
	p,
	h2 {
		color: #fff !important;
		margin: 0;
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

	.fonted {
		font-family: "Cormorant Garamond", Georgia, serif !important;
	}

	.form-control:focus {
		box-shadow: none;
	}

	.form-control-underlined {
		border-width: 0;
		border-bottom-width: 1px;
		border-radius: 0;
		padding-left: 0;
	}

	.form-control::placeholder {
		color: #aaa;
		font-style: italic;
	}

	#submit:hover {
		background: #EA272D !important;
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
			<div class="row mb-5">
				<div class="col-md-12">
					<h2 class="mid-text">Buat Akun</h2>
				</div>
			</div>
			<div class="row px-3">
				<div class="col-md-8">
					<form action="">
						<div class="form-group">
							<label style="font-size:20px;" class="font-weight-bold mb-0" for="email">Nama</label>
							<input type="text"
								class="fonted bg-transparent text-white form-control form-control-underlined py-0"
								name="nama" autocomplete="off" placeholder="Masukkan nama Anda">
						</div>
						<div class="form-group">
							<label style="font-size:20px;" class="font-weight-bold mb-0" for="email">Email</label>
							<input type="text"
								class="fonted bg-transparent text-white form-control form-control-underlined py-0"
								name="email" autocomplete="off" placeholder="Masukkan email Anda">
						</div>
						<div class="form-group"><label style="font-size:20px;" class="font-weight-bold mb-0"
								for="email">Password</label>
							<input type="password"
								class="fonted bg-transparent text-white form-control form-control-underlined py-0"
								name="password" autocomplete="off"
								placeholder="Password minimal 8 karakter gabungan huruf dan angka">
						</div>
						<div class="form-group"><label style="font-size:20px;" class="font-weight-bold mb-0"
								for="email">Konfirmasi Password</label>
							<input type="password"
								class="fonted bg-transparent text-white form-control form-control-underlined py-0"
								name="password_confirmation" autocomplete="off"
								placeholder="Ketik ulang password yang sudah anda buat">
						</div>
						<button id="submit" type="submit" class="bg-dark btn text-light w-100">Buat Akun</button>
					</form>
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
			var quantity = parseInt($(this).parent().siblings('.quantity').val());
			
			// var quantity = parseInt($('#quantity').val());
			
			// If is not undefined
			if(quantity!=parseInt($(this).parent().siblings('.quantity').attr('max'))){
				// console.log($('#quantity').attr('max'));
				// console.log(quantity);
				// $(this).attr('disabled','disabled');
				$(this).parent().siblings('.quantity').val(quantity + 1);
			}
		});
		$('.quantity-left-minus').click(function(e){
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($(this).parent().siblings('.quantity').val());
			
			// If is not undefined
		
				// Increment
			if(quantity>1){
				$(this).parent().siblings('.quantity').val(quantity - 1);
			}
		});
		$('.input-number').keyup(function(){
			var thiz = $(this);
			setTimeout(function(){
				if (thiz.val() < parseInt(thiz.attr('min')))
					thiz.val(parseInt(thiz.attr('min')));
				if (thiz.val() > parseInt(thiz.attr('max')))
					thiz.val(parseInt(thiz.attr('max')));
			},2000);
		});
		$(".btn-hovered").hover(function() {
			$(this).removeClass("btn-primary");
		}, function() {
			$(this).addClass("btn-primary");
		});
		// $('.input-number').change(function(){
		// 	console.log("aaa");
		// 	if($(this).val()==$(this).attr('min')){
		// 		console.log("aaa");
		// 	}
		// });
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