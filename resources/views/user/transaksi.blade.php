@extends('layouts.master')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
	p,
	h2 {
		color: #fff !important;
		margin: 0;
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

	.img-carousel {
		max-height: 650px;
		object-fit: cover;
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
		margin-bottom: 5%;
		margin-left: -50%;
	}

	.mid-text:after {
		left: 0.5em;
		margin-bottom: 5%;
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

	button .fa-bell {
		color: #EA272D !important;
	}

	.dropdown .btn {
		background-color: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.3) !important;
		box-shadow: none !important;
	}

	.dropdown .dropdown-item {
		color: white !important;
		font-size: 14px !important;
		background: black !important;
	}

	.bootstrap-select .dropdown-toggle .filter-option {
		color: white !important;
	}


	.dropdown-menu {
		background-color: black !important;
	}

	.bs-searchbox input:focus {
		background-color: black !important;
		color: white !important;
		border: 1px solid rgba(255, 255, 255, 0.3) !important;
	}

	.disabled-event {
		pointer-events: none;
		opacity: 0.7;
	}

	.card-style-black {
		background: rgba(0, 0, 0, 0.3) !important;
	}

	.edit-userimg {
		width: 200px;
		height: 200px;
		object-fit: cover;
	}

	.edit-userimg-btn {
		padding: 0;
		padding-top: 12px;
		width: 50px;
		height: 50px;
	}

	/* .select {
		font-size: 14px;
		background-color: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.3) !important;
		box-shadow: none !important;
	}

	.select:focus {
		background-color: transparent !important;
		border-color: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.3) !important;
		color: white !important;
	}

	.select option {
		background-color: black !important;
		color: white !important;
	}

	*/
	.trans-img {
		width: 130px;
		height: 130px;
		border-radius: 50%;
		object-fit: cover;
	}
</style>
@endsection
@section('content')
<div id="fh5co-featured-menu" class="fh5co-section py-0">
	<div id="fh5co-about" class="fh5co-section">
		@csrf
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">
					@if ($transaction->proof_of_payment==NULL && $transaction->status!="canceled")
					<div id="timeout" data-datetime="{{$transaction->timeout}}">
						<h2 class="mid-text">
							<div class="d-inline-block" style="width:300px;">
								<span class="d-inline-block">
									<span id="jam" class="text-center"></span>
									<span style="font-size:30px" class="pl-3 d-block text-left">jam </span>
								</span>
								<span class="d-inline-block">
									<span id="menit" class="text-center"></span>
									<span style="font-size:30px" class="d-block text-left">menit </span>
								</span>
								<span class="d-inline-block">
									<span id="detik" class="text-center"></span>
									<span style="font-size:30px" class="d-block text-left">detik
									</span>
								</span>
							</div>
						</h2>
					</div>
					@endif
					@if ($transaction->proof_of_payment!=NULL && $transaction->status=="unverified")
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Bukti pembayaran Anda telah berhasil
						diunggah. Sedang menunggu untuk diverifikasi oleh Admin</h3>
					@elseif ($transaction->status=="verified")
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Pembayaranmu <span
							style="color:#EA272Dl;">sudah
							diverifikasi</span> ! Paketmu
						sedang disiapkan...</h3>

					@elseif ($transaction->status=="delivered")
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Barang-barangmu sedang dalam perjalanan !
						Bersabarlah semeton...</h3>
					@elseif($transaction->status=="success")
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Terima kasih telah berbelanja ! Berikan
						ulasanmu terhadap produk kami ya !</h3>
					@elseif($transaction->status=="expired")
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Transaksi ini telah kadaluarsa karena
						melewati batas pembayaran</h3>
					@elseif($transaction->status=="canceled")
					<h3 style="color:#EA272D;" id="alert-unggah" class="mt-4 text-center">Transaksi ini telah dibatalkan
					</h3>
					@else
					<h3 id="alert-unggah" class="mt-4 text-light text-center">Unggah bukti pembayaran sebelum waktu
						habis!</h3>
					@endif

				</div>
			</div>
		</div>
		<div class="row px-3">
			<div class="col-md-8">
				<div class="card-style card-action rounded p-3 mb-2 position-relative">
					<h3 class="text-light text-center">Rincian Transaksi</h3>
					@foreach ($detail_transaksi as $item)
					<div class="card card-style-black px-3 py-2">
						<div class="d-flex align-items-center justify-content-between mb-4ex">
							<div class="d-flex align-items-center">
								<div style="width:150px" class="position-relative mr-4">
									@if (is_null($transaction->products[$loop->index]->images->first()))
									<a href="/products/{{$item->id}}/detail"><img class="trans-img"
											src="/images/products/null.png" alt="Tidak ada gambar"></a>
									@else
									<a href="/products/{{$transaction->products[$loop->index]->id}}/detail"><img
											class="trans-img"
											src="/images/products/{{$transaction->products[$loop->index]->images->first()->image_name}}"
											alt="Tidak ada gambar"></a>
									@endif
									{{-- @if(!is_null($transaction->products[$loop->index]->getActiveDiscount()))
										<div class="discount-label"></div>
										<p class="discount-text">30%</p>
										@endif --}}
								</div>
								<div>
									<h4 class="text-light"><a class="text-light"
											href="/products/{{$transaction->products[$loop->index]->id}}/detail">{{$transaction->products[$loop->index]->product_name}}</a>
									</h4>
									@if(Auth::user()->manyNotReviewed($transaction->products[$loop->index])>0 &&
									$transaction->status=="success")
									<a href="/products/{{$transaction->products[$loop->index]->id}}/detail"
										class="btn btn-primary">Beri Ulasan</a>
									@endif
								</div>
							</div>
							<div class="pl-4" style="border-left: 1px solid #EA272D">
								<div class="d-flex justify-content-between">
									<p class="text-light mb-0 mr-5">Harga Barang</p>
									@if(!is_null($transaction->products[$loop->index]->getActiveDiscount()))
									<p class="font-weight-bold text-light px-3"><span class="harga"
											data-price="{{$transaction->products[$loop->index]->getPriceOrDiscountedPrice()}}"
											id="price{{$transaction->products[$loop->index]->id}}">Rp
											{{number_format($transaction->products[$loop->index]->getPriceOrDiscountedPrice(),0,',','.')}}</span>
										<sup style="color:red;text-decoration:line-through" class=""><span
												style="color:white;">{{number_format($transaction->products[$loop->index]->price,0,',','.')}}</span></sup>
									</p>
									@else
									<p id='0' class=" font-weight-bold text-light harga px-3">Rp
										{{number_format($transaction->products[$loop->index]->price,0,',','.')}}
									</p>
									@endif
								</div>
								<div class="d-flex justify-content-between" style="border-bottom:1px solid #EA272D">
									<p class="text-light mb-0 mr-5">Jumlah Barang</p>
									<p class="text-light mb-0">{{$item->qty}}</p>
								</div>
								<div class="d-flex justify-content-between mb-3">
									<p class="text-light mb-0 mr-5">Subtotal</p>
									<p class="text-light mb-0">
										Rp {{number_format($item->selling_price*$item->qty,0,',','.')}}</p>
								</div>
								{{-- <div class="d-flex justify-content-between">
										<p class="text-light mb-0 mr-5">Subtotal</p>
										<p class="text-light mb-0">1x 250.000</p>
									</div>
									<div style="border-bottom:1px solid #EA272D" class="d-flex justify-content-between">
										<p class="text-light mb-0 mr-5">Ongkos Kirim</p>
										<p class="text-light mb-0">1x 250.000</p>
									</div>
									<div class="d-flex justify-content-between">
										<p class="text-light mb-0 mr-5">Total Bayar</p>
										<p class="text-light mb-0">400.000</p>
									</div> --}}
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				@if($transaction->status=="delivered")
				<div class="card-style mb-3 rounded p-4 detail-pengiriman">
					<h4 class="text-light text-center font-weight-bold">Konfirmasi Barang</h4>
					<p>Konfirmasi barang jika barang sudah sampai dengan menekan tombol di bawah ini. Harap periksa
						kelengkapan barang.</p>
					<div class="text-center mt-3">
						<form id="deliveredSuccess" action="/transaksi/{{$transaction->id}}/update-status"
							method="POST">
							@csrf
							<input name="status" type="hidden" value="success">
							<button onclick="confirm('Apakah anda yakin ingin mengkonfirmasi barang telah tersampai?')"
								id="{{$transaction->id}}" type="submit" class="btn btn-danger text-center"
								for="delivered_success">Barang
								Sudah Sampai</button>
						</form>
					</div>
				</div>
				@endif
				<div class="card-style mb-3 rounded p-4 detail-pengiriman">
					<h4 class="text-light text-center font-weight-bold">Pengiriman</h4>
					<div class="d-flex justify-content-between">
						<p>Kurir</p>
						<p>{{Str::upper($transaction->courier->courier)}}
						</p>
					</div>
					<h4 class="text-light text-center font-weight-bold">Rincian Biaya</h4>
					<div class="d-flex justify-content-between">
						<p>Total Harga Barang</p>
						<p>Rp <span id="total-harga-barang"
								data-price="{{$transaction->sub_total}}">{{number_format($transaction->sub_total,0,',','.')}}</span>
						</p>
					</div>
					<div class="d-flex justify-content-between">
						<p>Biaya Pengiriman</p>
						<p id="ongkir-final">Rp {{number_format($transaction->shipping_cost,0,',','.')}}</p>
					</div>
					<div class="mt-3 d-flex justify-content-between">
						<p class="font-weight-bold">Total yang harus Dibayar</p>
						<p class="font-weight-bold" id="total">Rp {{number_format($transaction->total,0,',','.')}}
						</p>
					</div>
				</div>
				@if($transaction->status=="unverified")
				<div class="card-style rounded p-4 text-center">
					<form id="photoForm" action="/transaksi/upload-bukti" method="POST" enctype="multipart/form-data">
						@csrf
						<h4 class="text-light text-center font-weight-bold">Unggah Bukti Pembayaran</h4>
						<img style="{{$transaction->proof_of_payment!=NULL ? 'display:inline;' : 'display:none;'}}"
							class="edit-userimg mx-auto" src="{{'/images/verif/'.$transaction->proof_of_payment}}"
							alt="Avatar">
						<div class="text-center mt-2">
							<label id="{{$transaction->id}}" class="btn btn-danger text-center"
								for="upload-photo">Unggah Bukti
								Pembayaran</label>
							<input type="file" name="proof_of_payment" id="upload-photo" style="display: none">
							<input type="hidden" name="id" value="{{$transaction->id}}">
						</div>
					</form>
					<div class="text-center mt-2">
						<form id="canceledForm" action="/transaksi/{{$transaction->id}}/update-status" method="POST">
							@csrf
							<input name="status" type="hidden" value="canceled">
							<button onclick="confirm('Apakah anda yakin ingin membatalkan transakasi ini?)"
								id="{{$transaction->id}}" type="submit" class="btn btn-danger text-center"
								for="delivered_success">Batalkan Transaksi</button>
						</form>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(function() {
		function countdown(){
			const timeout= new Date($('#timeout').attr('data-datetime')).getTime();
			const now = new Date().getTime();
			const gap = timeout-now;
			const second=1000;
			const minute=second * 60;
			const hour=minute*60;
			const day=hour*24;
			const textHour=Math.floor(gap/hour);
			const textMinute=Math.floor((gap%hour)/minute);
			const textSecond=Math.floor((gap%minute)/second);
			var formattedNumber = ("0" + textSecond).slice(-2);
			$('#jam').html(("0" + textHour).slice(-2)+" : ");
			$('#menit').html(("0" + textMinute).slice(-2)+" : ");
			$('#detik').html(("0" + textSecond).slice(-2));
		}
		setInterval(countdown,1000);
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
		$("[name='proof_of_payment'").change(function(e){
			loadFile(e);
		});
		console.log($('.edit-userimg').attr('src'));
		let _token = $('meta[name="csrf-token"]').attr('content');
		var loadFile = function(event) {
			var image = $('.edit-userimg');
			image.css('display','block');
			console.log($("[name='upload-photo'").val());
			image.attr('src',URL.createObjectURL(event.target.files[0]));
			$('#photoForm').submit();
		};
		$('#photoForm').submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': _token
				}
			});
			$.ajax({
				type: "POST",
				url: "/transaksi/upload-bukti",
				data: formData,
				contentType : false,
                processData : false,
				success: function(data){
					alert("Foto berhasil diupload");
					$('#alert-unggah').html("Bukti pembayaran Anda telah berhasil diunggah. Sedang menunggu untuk diverifikasi oleh Admin");
					$('#timeout').hide();
				},
				dataType: "JSON"
			});
		});
	});
</script>
@endsection