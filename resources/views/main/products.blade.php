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

	.bootstrap-select * {
		font-size: 16px;
	}

	.dropdown-menu {
		font-size: 14px;
		padding-top: 0 !important;
	}

	.dropdown-menu * {
		padding-top: 0 !important;
	}

	.dropdown-menu .active {
		color: black;
	}

	.bootstrap-select input:focus {
		background-color: transparent;
		font-size: 16px;
	}

	.bs-searchbox>input {
		border-bottom: 1px solid rgba(0, 0, 0, 0.76) !important;
		padding-bottom: 0 !important;
	}

	.rounded-capsule {
		border-radius: 16px;
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

	.fas {
		color: #EA272D;
	}

	.icon-background {
		color: transparent;
		transition: all 0.5s;
	}

	.cart:hover .icon-background {
		color: #EA272D;
	}

	.cart:hover .fa-stack-1x {
		color: white;
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
</style>
@endsection
@section('content')
<div id="fh5co-about" class="fh5co-section">
	<div class="container">
		<form id="searchForm" action="/products/search">
			<div class="row">
				<div class="col-md-3">
					<h3 class="text-white pt-2 mb-2 m-0 text-md font-weight-bold">Kategori</h3>
					<div>
						<div class="form-group bg-transparent">
							<select multiple name="category_id[]" class="form-control bg-transparent selectpicker"
								id="category" data-live-search="true">
								@foreach($categories as $category)
								<option value="{{$category->id}}" data-tokens="{{$category->category_name}}">
									{{$category->category_name}}</option>
								@endforeach
							</select>
							@error('category_id')
							<div class="invalid-feedback">
								{{$message}}
							</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="form-group mb-4">

						<div class="d-flex align-items-center">
							<input id="search" type="name" placeholder="Cari nama produk..." name="keyword"
								autocomplete="off"
								class="fonted bg-transparent text-white form-control form-control-underlined">
							<button class="py-3 btn bg-transparent" type="submit" value="submit" form="searchForm"><i
									class="fas fa-lg fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-md-3">

			</div>
			<div class="col-md-9">
				<div id="displayData" class="row">
					@foreach ($products as $product)
					<div class="col-md-4 mb-3">
						<div class="card card-style">
							<div>
								<div class="position-relative">
									@if (is_null($product->images->first()))
									<a href="/products/{{$product->id}}/detail"><img class="card-img-top card-crop"
											src="/images/products/null.png" alt="Tidak ada gambar"></a>
									@else
									<a href="/products/{{$product->id}}/detail"><img class="card-img-top card-crop"
											src="/images/products/{{$product->images->first()->image_name}}"
											alt="Tidak ada gambar"></a>
									@endif
									<div class="discount-label"></div>
									<p class="discount-text">30%</p>
								</div>
							</div>
							<div class="card-body">
								<h5 class="card-title font-weight-bold text-light">{{$product->product_name}}</h5>
								@if (count($product->categories)==1)
								<h6 class="d-inline-block card-subtitle mb-2 text-muted">
									{{$product->categories->first()->category_name}}</h6>
								@else
								@foreach ($product->categories as $category)
								@if ($loop->last)
								<h6 class="d-inline-block card-subtitle mb-2 text-muted">
									{{$category->category_name}}
								</h6>
								@else
								<h6 class="d-inline-block card-subtitle mb-2 text-muted">
									{{$category->category_name}},
								</h6>
								@endif
								@endforeach
								@endif
								<p class="card-text mb-3 text-light">{{$product->description}}</p>
								<p class="m-0 text-light bg-danger d-inline py-1 px-2 rounded-capsule">
									Rp.{{number_format($product->price,0,',','.')}}</p>
								<p class="mx-1 text-danger d-inline">
									<sup><s>Rp.{{number_format($product->price,0,',','.')}}</s></sup></p>
							</div>
							<div class="card-footer py-1 d-flex justify-content-between align-items-center">
								<a href="#" class="m-0 btn btn-hovered">Beli Langsung</a>
								<a class="cart" href="">
									<span class="fa-stack fa">
										<i class="fa fa-circle fa-stack-2x icon-background"></i>
										<i class="fas fa-shopping-cart fa-stack-1x"></i>
									</span>
								</a>
								<!-- <a href="#" class="mr-3"><i class="fas fa-cart-plus"></i></a> -->
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(function() {
		$('.selectpicker').selectpicker({
			noneSelectedText: 'Pilih Kategori',
			size: '4',
			// virtualScroll: '2',
		});
		$(".btn-hovered").hover(function() {
			$(this).addClass("btn-primary");
		}, function() {
			$(this).removeClass("btn-primary");
		});
		$(".cart").hover(function() {
			$(this).find(".fa-stack-2x").removeClass("icon-background");
			// $('.fa-stack-2x').removeClass("icon-background");
		}, function() {
			$(this).find(".fa-stack-2x").addClass("icon-background");
		});
		var base_path = "{{url('/')}}";
		$('#searchForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: `${base_path}/products/search`,
                dataType: "json",
                data: {
                    "keyword": $('#search').val(),
                    "category_id":$('#category').val(),
                },
                success: function(data) {
					console.log(data);
                    if (jQuery.isEmptyObject(data)) {
                        $('#displayData').html('');
                        if (!$('#no-result').length) {
                            $('#displayData').append("<h4 id='no-result' class='mt-2 text-center'>Tidak ada hasil</h4>");
                        }
                    } else {
                        // result=data;
                        // console.log(result);
                        // displayData(data[0]);
                        $('#displayData').html('');
                        $('#no-result').remove();
                        // console.log(data);
                        $.each(data, function(index, val) {
                            let item = `<div class="col-md-4 mb-3">
											<div class="card card-style">
												<div>
													<div class="position-relative">
														<a href="/products/${val.id}/detail"><img class="card-img-top card-crop"
																src="/images/products/${(val.images.length!=0) ? val.images[0].image_name : 'null.png'}" alt="Tidak ada gambar"></a>
														<div class="discount-label"></div>
														<p class="discount-text">30%</p>
													</div>
												</div>
												<div class="card-body">
													<h5 class="card-title font-weight-bold text-light">${val.product_name}</h5>
													${(() => {
													let categoryTag='';
													val.categories.forEach((category,key) => {
														if(key==val.categories.length-1){
															categoryTag=categoryTag+`<h6 class="d-inline-block card-subtitle mb-2 text-muted">${category.category_name}</h6>`;
														}else{
															categoryTag=categoryTag+`<h6 class="d-inline-block card-subtitle mb-2 text-muted">${category.category_name},</h6>`;
														}
													});
													return `${categoryTag}`;
													})()}
													<p class="card-text mb-3 text-light">${val.description}</p>
													<p class="m-0 text-light bg-danger d-inline py-1 px-2 rounded-capsule">
														Rp.${val.price}</p>
													<p class="mx-1 text-danger d-inline">
														<sup><s>Rp.${val.price}</s></sup></p>
												</div>
												<div class="card-footer py-1 d-flex justify-content-between align-items-center">
													<a href="#" class="m-0 btn btn-hovered">Beli Langsung</a>
													<a class="cart" href="">
														<span class="fa-stack fa">
															<i class="fa fa-circle fa-stack-2x icon-background"></i>
															<i class="fas fa-shopping-cart fa-stack-1x"></i>
														</span>
													</a>
												</div>
											</div>
										</div>`;
                            // console.log(val);
                            $('#displayData').append(item);
                        });
                    }
                }
            });
        });
	});
</script>
@endsection