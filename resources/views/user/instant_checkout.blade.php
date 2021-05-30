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

    button .fas {
        color: white !important;
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
        <form method="POST" id="checkoutForm" action="/product/checkout/send">
            @csrf
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="mid-text">Checkout</h2>
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-8">
                        <div class="card-style card-action rounded p-3 mb-2 position-relative">
                            <div class="form-group">
                                <label style="font-size:20px;" class="font-weight-bold mb-0"
                                    for="province">PROVINSI</label>
                                <select title="Pilih Provinsi" data-live-search="true"
                                    class="form-control select selectpicker1" id="province" name="province">
                                    @foreach ($daftarProvinsi as $provinsi)
                                    <option value='{{$provinsi->province_id}}' data-tokens="{{$provinsi->title}}">
                                        {{$provinsi->title}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('province')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label style="font-size:20px;" class="font-weight-bold mb-0" for="regency">KOTA</label>
                                <select title="Pilih Kota" data-live-search="true"
                                    class="disabled-event form-control select selectpicker2" id="kota" name="regency">
                                </select>
                                @error('regency')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label style="font-size:20px;" class="font-weight-bold mb-0"
                                    for="address">Alamat</label>
                                <input type="text"
                                    class="fonted bg-transparent text-white form-control form-control-underlined py-0 @error('address') is-invalid @enderror"
                                    name="address" autocomplete="off" placeholder="Masukkan alamat Anda">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label style="font-size:20px;" class="font-weight-bold mb-0"
                                    for="pengiriman">PENGIRIMAN</label>
                                <select title="Pilih Kurir" data-live-search="true"
                                    class="disabled-event form-control select selectpicker3" id="pengiriman"
                                    name="courier_id">
                                    @foreach ($couriers as $courier)
                                    <option value='{{$courier->courier}}' data-tokens="{{$courier->courier}}">
                                        {{Str::upper($courier->courier)}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('courier_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <div class="divpaket">
                                    <select title="Pilih Paket" data-live-search="true"
                                        class="disabled-event mt-3 form-control select selectpicker4" id="paket"
                                        name="paket">
                                    </select>
                                    @error('paket')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-style mb-3 rounded p-4 detail-pengiriman">
                            <h4 class="text-light text-center font-weight-bold">Biaya Pengiriman</h4>
                            <div class="d-flex justify-content-between">
                                <p>Total Berat Barang</p>
                                <p><span id="weight">{{$product->weight * $qty}}</span> gram</p>
                            </div>
                        </div>
                        <div class="card-style rounded p-4">
                            <h4 class="text-light text-center font-weight-bold">Total Biaya</h4>
                            <div class="d-flex justify-content-between">
                                <p>Total Harga Barang</p>
                                <p>Rp <span id="total-harga-barang"
                                        data-price="{{$product->getPriceOrDiscountedPrice() * $qty}}">{{number_format($product->getPriceOrDiscountedPrice() * $qty,0,',','.')}}</span>
                                </p>
                                <input name="sub_total" type="hidden"
                                    value="{{$product->getPriceOrDiscountedPrice() * $qty}}">
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Biaya Pengiriman</p>
                                <p id="ongkir-final">-</p>
                                <input name="shipping_cost" type="hidden" value="">
                                <input name="product_id" type="hidden" value="{{$product->id}}">
                                <input name="qty" type="hidden" value="{{$qty}}">
                            </div>
                            <div class="mt-4" id="pembayaran-menu">
                                <select title="Pilih Metode Pembayaran" data-live-search="true"
                                    class="form-control select selectpicker5" id="pembayaran" name="pembayaran">
                                    <option value='bni' data-tokens="BNI">
                                        BNI
                                    </option>
                                    <option value='bca' data-tokens="BCA">
                                        BCA
                                    </option>
                                    <option value='mandiri' data-tokens="MANDIRI">
                                        MANDIRI
                                    </option>
                                    <option value='bri' data-tokens="BRI">
                                        BRI
                                    </option>
                                </select>
                                <button type="submit"
                                    class="w-100 d-block mt-3 mb-2 mx-auto btn btn-primary btn-hovered">Beli</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {
		$('#pembayaran-menu').hide();
		$('.selectpicker1').selectpicker({
			noneSelectedText: 'Pilih Provinsi',
			size: '4',
			// virtualScroll: '2',
		});
		$('.selectpicker2').selectpicker({
			noneSelectedText: 'Pilih Kota/Kabupaten',
			size: '4',
			// virtualScroll: '2',
		});
		$('.selectpicker3').selectpicker({
			noneSelectedText: 'Pilih Kurir',
			size: '4',
			// virtualScroll: '2',
		});
		$('.selectpicker4').selectpicker({
			noneSelectedText: 'Pilih Paket',
			size: '4',
			// virtualScroll: '2',
		});
		$('.selectpicker5').selectpicker({
			noneSelectedText: 'Pilih Paket',
			size: '4',
			// virtualScroll: '2',
		});
		$('.selectpicker1').on('change', function () {
			let _token = $('meta[name="csrf-token"]').attr('content');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': _token
				}
			});
			let province_id=$('#province').val();
			console.log(province_id);
			$('#kota').html('');
			$.ajax({
				type: "POST",
				url: "/cart/checkout/get-city",
				data: {
                    'province_id': province_id,
                },
				success: function(kotaArr){
					kotaArr.forEach(kota => {
						$('#kota').append(`<option value='${kota.city_id}' data-tokens="${kota.title}">${kota.title}</option>`)
					});
					$("#kota").selectpicker("refresh")
					$('label[for="regency"]').siblings('.bootstrap-select').removeClass("disabled-event");
				},
				dataType: "JSON"
			});
		});
		$('.selectpicker2').on('change', function () {
			if($('#province').val()!='' && $('#kota').val()!=''){
				$('label[for="pengiriman"]').siblings('.bootstrap-select').removeClass("disabled-event");
				$('label[for="regency"]').siblings('.bootstrap-select').removeClass("disabled-event");
			}
			if($('#pengiriman').val()!=''){
				$('#paket').html('');
				// console.log(province_id);
				// console.log(city_id);
				// console.log($('#weight').html());
				$.ajax({
					type: "POST",
					url: "/cart/checkout/get-ongkir",
					data: {
						'province_id': parseInt($('#province').val()),
						'city_id':parseInt($('#kota').val()),
						'weight':parseInt($('#weight').html()),
						'courier':$('#pengiriman').val()
					},
					success: function(ongkir){
						console.log(ongkir);
						ongkir.costs.forEach(paket => {
							$('#paket').append(`<option value='${paket.cost[0].value}&${paket.cost[0].etd}' data-tokens="${paket.service}">${paket.service} - Rp ${formatRupiah(paket.cost[0].value)}</option>`)
						});
						$("#paket").selectpicker("refresh");
						$('.divpaket .bootstrap-select').removeClass("disabled-event");
					},
					dataType: "JSON"
				});
			}
		});
		$('.selectpicker3').on('change', function () {
			if($('#pengiriman').val()!=''){
				$('.divpaket .bootstrap-select').removeClass("disabled-event");
			}
			let _token = $('meta[name="csrf-token"]').attr('content');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': _token
				}
			});
			$('#paket').html('');
			// console.log(province_id);
			// console.log(city_id);
			// console.log($('#weight').html());
			$.ajax({
				type: "POST",
				url: "/cart/checkout/get-ongkir",
				data: {
                    'province_id': parseInt($('#province').val()),
					'city_id':parseInt($('#kota').val()),
					'weight':parseInt($('#weight').html()),
					'courier':$('#pengiriman').val()
                },
				success: function(ongkir){
					console.log(ongkir);
					ongkir.costs.forEach(paket => {
						$('#paket').append(`<option value='${paket.cost[0].value}&${paket.cost[0].etd}' data-tokens="${paket.service}">${paket.service} - Rp ${formatRupiah(paket.cost[0].value)}</option>`)
					});
					$("#paket").selectpicker("refresh");
					$('.divpaket .bootstrap-select').removeClass("disabled-event");
				},
				dataType: "JSON"
			});
		});
		$('.selectpicker4').on('change', function () {
			$('.detail-pengiriman .detail-pengiriman-item').remove();
			let formattedValue=($(this).val().split("&"));
			let cost=formattedValue[0];
			let etd=formattedValue[1];
			$('.detail-pengiriman').append(`<div class="d-flex justify-content-between detail-pengiriman-item">
							<p>Estimasi Lama Pengiriman</p>
							<p><span id="etd">${etd}</span> hari</p>
						</div>`);
			$('.detail-pengiriman').append(`						<div class="d-flex justify-content-between detail-pengiriman-item">
							<p>Biaya Pengiriman</p>
							<p><span id="ongkir">Rp ${formatRupiah(cost)}</span></p>
						</div>`);
			$('#ongkir-final').html(`Rp ${formatRupiah(cost)}`);
			$('[name="shipping_cost"]').val(`${cost}`);
			$('#pembayaran-menu').show();
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
	});
</script>
@endsection