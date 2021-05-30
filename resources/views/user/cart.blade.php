@extends('layouts.master')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
	p,
	h2 {
		color: #fff !important;
		margin: 0;
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

	.card-action {
		position: relative;
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
		max-width: 30px !important;
	}

	.input-number::-webkit-outer-spin-button,
	.input-number::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	.btn-delete {
		position: absolute;
		top: 0;
		right: 0;
		border-radius: 5px !important;
		padding: 5px 10px;
		font-size: 12px;
	}

	.fa-plus,
	.fa-minus {
		font-size: 12px;
	}

	button .fa-trash {
		color: white !important;
	}

	.modal-content {
		background: rgba(56, 59, 57, 0.95) !important;
		color: white !important;
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
					<h2 class="mid-text">Keranjang</h2>
				</div>
			</div>
			<div class="row px-3">
				<div class="col-md-8">
					@if($carts->count()==0)
					<div class="card-style card-action rounded p-3 mb-2">
						<h3 class="text-light text-center">Cart Kosong</h3>
					</div>
					@else
					@foreach ($carts as $item)
					<div class="card-style card-action rounded p-3 mb-2">
						<h3 class="font-weight-bold text-light">{{$item->product->product_name}}</h3>
						<button data-toggle="modal" data-target="#exampleModal" id="{{$item->id}}" type="button"
							class="m-0 btn btn-danger text-light btn-delete del-button">
							<i class="fas fa-trash"></i>
						</button>
						<div style="width:200px" class="position-relative">
							@if (is_null($item->product->images->first()))
							<a href="/products/{{$item->id}}/detail"><img class="card-img-top card-crop"
									src="/images/products/null.png" alt="Tidak ada gambar"></a>
							@else
							<a href="/products/{{$item->product->id}}/detail"><img class="card-img-top card-crop"
									src="/images/products/{{$item->product->images->first()->image_name}}"
									alt="Tidak ada gambar"></a>
							@endif
							@if(!is_null($item->product->getActiveDiscount()))
							<div class="discount-label"></div>
							<p class="discount-text">30%</p>
							@endif
						</div>
						<div class="mt-5 input-group d-flex justify-content-between align-items-center">
							<p class="font-weight-bold m-0">Harga Satuan Produk</p>
							@if(!is_null($item->product->getActiveDiscount()))
							<h4 class="font-weight-bold text-light px-3"><span class="harga"
									data-price="{{$item->product->getPriceOrDiscountedPrice()}}"
									id="price{{$item->product->id}}">Rp
									{{number_format($item->product->getPriceOrDiscountedPrice(),0,',','.')}}</span>
								<sup style="color:red;text-decoration:line-through" class=" pl-2"><span
										style="color:white;">{{number_format($item->product->price,0,',','.')}}</span></sup>
							</h4>
							@else
							<h4 id='0' class=" font-weight-bold text-light harga px-3">Rp
								{{number_format($item->product->price,0,',','.')}}
							</h4>
							@endif
							{{-- <p id="price{{$item->product->id}}"
							data-price="{{$item->product->getPriceOrDiscountedPrice()}}"
							class="font-weight-bold mr-4">Rp
							{{number_format($item->product->getPriceOrDiscountedPrice(),0,',','.')}}
							</p> --}}
						</div>
						<div class="input-group d-flex justify-content-between align-items-center">
							<p class="font-weight-bold my-3">Jumlah Produk</p>
							<div>
								<span class="input-group-btn p-0 m-0">
									<button type="button" class="m-0 quantity-left-minus btn bg-transparent btn-number"
										data-type="minus" data-field="">
										<i class="fas fa-minus text-light"></i>
										{{-- <span class="glyphicon glyphicon-minus"></span> --}}
									</button>
								</span>
								<input type="number" name="quantity"
									class="quantity form-control p-0 text-light input-number d-inline-block text-center p-0 m-0"
									value="{{$item->qty}}" max="{{$item->product->stock}}" data-id="{{$item->id}}"
									data-price="{{$item->product->getPriceOrDiscountedPrice()}}" min="1">
								<span class="input-group-btn p-0 m-0">
									<button type="button" class="m-0 quantity-right-plus btn bg-transparent btn-number"
										data-type="plus" data-field="">
										<i class="fas fa-plus text-light"></i>
										{{-- <span class="glyphicon glyphicon-plus"></span> --}}
									</button>
								</span>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
				<div class="col-md-4">
					<div class="card-style rounded p-4">
						<h4 class="text-light text-center font-weight-bold">Ringkasan Belanja</h4>
						@foreach ($carts as $item)
						<div class="d-flex justify-content-between">
							<p>{{$item->product->product_name}}</p>
							<p class="subtottt" id="subtotal{{$item->id}}"
								data-price="{{$item->product->price * $item->qty}}">Rp
								{{number_format($item->qty*$item->product->getPriceOrDiscountedPrice(),0,',','.')}}
							</p>
						</div>
						@endforeach
						<div class="d-flex justify-content-between">
							<p>Total Harga Barang</p>
							<p id="total">Rp
								{{number_format($total,0,',','.')}}
							</p>
						</div>
						<a href="/cart/checkout" class="d-block mt-3 mb-2 mx-auto btn btn-primary btn-hovered">Beli</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-titl text-light">Hapus Produk dari Keranjang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Apakah Anda yakin ingin menghapus produk ini dari keranjang?</p>
			</div>
			<div class="modal-footer">
				<form id="delForm" method="post">
					@csrf
					@method('delete')
					<button type="submit" class="btn btn-danger">Hapus Produk</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
		$('.del-button').click(function(){
            $('#delForm').attr('action',`/cart/${$(this).attr('id')}/delete`);
        });
		function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
		var quantitiy=0;
		$('.quantity-right-plus').click(function(e){
				
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($(this).parent().siblings('.quantity').val());
			
			// var quantity = parseInt($('#quantity').val());

			// If is not undefined
			if(quantity+1<=parseInt($(this).parent().siblings('.quantity').attr('max'))){
				// console.log($('#quantity').attr('max'));
				// console.log(quantity);
				// $(this).attr('disabled','disabled');
				$(this).parent().siblings('.quantity').val(quantity + 1);
				var price = parseInt($(this).parent().siblings('.quantity').attr('data-price'));
				var id =$(this).parent().siblings('.quantity').attr('data-id');
				// $(`#price${id}`).html("Rp " + formatRupiah(price*(quantity+1)));
				$(`#subtotal${id}`).html("Rp " + formatRupiah(price*(quantity+1)));
				let crtPrice=parseInt($(`#subtotal${id}`).attr('data-price'));
				$(`#subtotal${id}`).attr('data-price',crtPrice+price);
				updateQ(id,quantity+1);
				$('#total').html(`Rp ${formatRupiah(updateTotal())}`);
			}else{
				alert('Stok habis!');			
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
				var price = parseInt($(this).parent().siblings('.quantity').attr('data-price'));
				var id =$(this).parent().siblings('.quantity').attr('data-id');
				// $(`#price${id}`).html("Rp " + formatRupiah(price*(quantity-1)));
				$(`#subtotal${id}`).html("Rp " + formatRupiah(price*(quantity-1)));
				let crtPrice=parseInt($(`#subtotal${id}`).attr('data-price'));
				$(`#subtotal${id}`).attr('data-price',crtPrice-price);
				updateQ(id,quantity-1);
				$('#total').html(`Rp ${formatRupiah(updateTotal())}`);
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
		function updateQ(cart_id,quantity){
			let carted_id=parseInt(cart_id);
			let _token = $('meta[name="csrf-token"]').attr('content');
			console.log(carted_id);
			console.log(quantity);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': _token
				}
			});
			$.ajax({
				type: "POST",
				url: "/cart/update",
				data: {
                    'cart_id': carted_id,
                    'qty':quantity,
                },
				success: function(data){
					console.log("aa");
				},
				dataType: "JSON"
			});
		}
		function updateTotal(){
			let subtotalArr=$('.subtottt');
			console.log(subtotalArr);
			let total=0;
			$.each(subtotalArr,function(index, value ) {
				total+=parseInt(value.getAttribute('data-price'));
			});
			return total;
		}
	});
</script>
@endsection