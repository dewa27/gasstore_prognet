@extends('layouts.master')
@section('head')
<style>
	.flex-direction-nav {
		width: 100%;
		position: absolute;
		top: 45%;
	}

	.flex-direction-nav a.flex-next {
		right: 50px !important;
	}

	.text-danger {
		color: #EA272D !important;
	}

	.bg-danger {
		background-color: #EA272D !important;
	}

	.fonted {
		font-family: "Cormorant Garamond", Georgia, serif !important;
	}

	.rounded-capsule {
		border-radius: 16px;
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

	.side-nav {
		color: white;
		font-size: 18px;
		text-decoration: none;
	}

	.side-nav-list {
		list-style-type: none;

	}

	.white-border {
		border-bottom: 1px solid white;
	}

	.red-border {
		border-bottom: 1px solid #EA272D;
		transition: all 0.5s;
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

	.fas {
		color: #EA272D;
	}

	.fa-bell {
		color: #EA272D !important;
	}

	.trans-img {
		width: 50px;
		height: 50px;
		border-radius: 50%;
		object-fit: cover;
	}

	.edit-userimg-container {
		position: relative;
	}

	.status-box {
		position: absolute;
		top: 0;
		right: 0;
	}
</style>
@endsection
@section('content')
<div id="fh5co-about" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 p-0">
				<h2 class="mid-text text-light">Riwayat Transaksi</h2>
				@foreach ($transactions as $item)
				<div class="card card-style px-4 py-3 mb-2 position-relative">
					<div class="status-box card px-2 py-1" style="background-color: #EA272D">
						<span style="font-size:14px;" class="text-light">{{$item->status}}</span>
					</div>
					<div class="card-body">
						<p class="text-light mb-2"><span
								class="font-weight-bold">{{$item->created_at->format('d M Y')}}</span><span
								class="ml-3 font-italic">{{$item->created_at->format('H:m:s')}}
								WITA</span>
						</p>
						<div class="d-flex align-items-center justify-content-between mb-4">
							<div>
								@foreach ($item->detail_transaksi as $row_detail)
								<div class="mb-2">
									<img class="trans-img mr-4"
										src="images/products/{{$row_detail->product->images->first()->image_name}}"
										alt="">
									<div class="d-inline-block">
										<p class="text-light mb-0 d-inline-block mr-3">
											{{$row_detail->product->product_name}}
										</p>
										<p style="border-left: 1px solid #EA272D"
											class="text-light mb-0 d-inline-block pl-3 mr-3">{{$row_detail->qty}} pcs
										</p>
										@if(!is_null($row_detail->discount))
										<p style="border-left: 1px solid #EA272D"
											class="text-light mb-0 d-inline-block pl-3">
											Rp {{number_format($row_detail->selling_price,0,',','.')}}
											<sup style="color:red;text-decoration:line-through" class="pl-2">
												<span style="color:white;">
													Rp {{number_format($row_detail->product->price,0,',','.')}}</span>
											</sup>
										</p>
										@else
										<p style="border-left: 1px solid #EA272D"
											class="text-light mb-0 d-inline-block pl-3">
											Rp {{number_format($row_detail->product->price,0,',','.')}}</p>
										@endif
									</div>
								</div>
								@endforeach
							</div>
							<div class="pl-4" style="border-left: 1px solid #EA272D">
								<div class="d-flex justify-content-between">
									<p class="text-light mb-0 mr-5">Subtotal</p>
									<p class="text-light mb-0">Rp {{number_format($item->sub_total,0,',','.')}}</p>
								</div>
								<div style="border-bottom:1px solid #EA272D" class="d-flex justify-content-between">
									<p class="text-light mb-0 mr-5">Ongkos Kirim</p>
									<p class="text-light mb-0">Rp {{number_format($item->shipping_cost,0,',','.')}}</p>
								</div>
								<div class="d-flex justify-content-between">
									<p class="text-light mb-0 mr-5">Total Bayar</p>
									<p class="text-light mb-0">Rp {{number_format($item->total,0,',','.')}}</p>
								</div>
							</div>
						</div>
						{{-- @if ($item->status=="success")
						<button class="btn">Beri Ulasan</button>
						@endif --}}
						<a href="/transaksi/{{$item->id}}/detail" class="btn btn-hovered">Lihat Detail Transaksi</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">

			</div>
			<div class="col-md-9">
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(function() {
		$(".side-nav").hover(function() {
			$(this).parent().addClass("red-border");
		}, function() {
			$(this).parent().removeClass("red-border");
		});
		$(".btn-hovered").hover(function() {
			$(this).addClass("btn-primary");
		}, function() {
			$(this).removeClass("btn-primary");
		});
	});
</script>
@endsection