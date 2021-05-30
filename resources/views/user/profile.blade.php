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

	.edit-userimg {
		width: 200px;
		height: 200px;
		border-radius: 50%;
		object-fit: cover;
	}

	.edit-userimg-btn {
		padding: 0;
		padding-top: 12px;
		width: 50px;
		height: 50px;
		border-radius: 50% 50% 50% 50%;
		position: absolute;
		bottom: 0%;
		left: 55%;
	}

	.edit-userimg-container {
		position: relative;
	}

	.disabled {
		opacity: 0.75 !important;
	}

	.btn-batal-edit {
		color: white !important;
		background: mediumslateblue !important;
	}
</style>
@endsection
@section('content')
<div id="fh5co-about" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="side-nav-list card-style px-3 py-2">
					<li class="mb-2 py-2 white-border"><a class="side-nav" href="/edit/profile">Edit Profile</a></li>
					<li class="mb-2 py-2 white-border"><a class="side-nav" href="/password/reset">Reset Password</a>
					</li>
				</ul>
			</div>
			<div class="col-md-9 p-4 card-style position-relative">
				<div>
					<button style="top:0;right:0;border-radius:0;"
						class="position-absolute btn btn-danger edit-profile pt-1">Edit Profil</button>
				</div>
				<form action="/edit/profile" method="POST" enctype="multipart/form-data">
					@csrf
					@if(!is_null(Auth::user()->profile_image))
					<div class="text-center edit-userimg-container">
						<img class="edit-userimg" src="/images/{{Auth::user()->profile_image}}" alt="Avatar">
						<label class="btn btn-danger edit-userimg-btn input disabled"><i
								style="font-size:20px;cursor:pointer;" class="fa fa-picture-o"></i></label>
						<input onchange="loadImage(event)" type="file" name="profile_image" id="upload-photo"
							style="display: none">
					</div>
					@else
					<div class="text-center edit-userimg-container">
						<img class="edit-userimg" src="/images/gallery_1.jpeg" alt="Avatar">
						<label disabled class=" btn btn-danger edit-userimg-btn input
							disabled"><i style="font-size:20px;" class="fa fa-picture-o"></i></label>
						<input type="file" name="profile_image" id="upload-photo" style="display: none">
					</div>
					@endif
					<div class="form-group">
						<label style="font-size:20px;" class="font-weight-bold mb-0" for="email">Nama</label>
						<input disabled type="text"
							class="@error('name') is-invalid @enderror fonted bg-transparent text-white form-control form-control-underlined py-0 input disabled"
							name="name" autocomplete="off" value="{{Auth::user()->name}}"
							placeholder="Masukkan nama Anda">
						@error('name')
						<div class="invalid-feedback">
							{{$message}}
						</div>
						@enderror
					</div>
					<div class="form-group">
						<label style="font-size:20px;" class="font-weight-bold mb-0" for="email">Email</label>
						<input disabled type="text"
							class="@error('email') is-invalid @enderror fonted bg-transparent text-white form-control form-control-underlined py-0 input disabled"
							name="email" value="{{Auth::user()->email}}" autocomplete=" off"
							placeholder="Masukkan email Anda">
						@error('email')
						<div class="invalid-feedback">
							{{$message}}
						</div>
						@enderror
					</div>
					<button disabled id="submit" type="submit"
						class="bg-dark btn text-light w-100 input disabled">Simpan
						Perubahan</button>
				</form>
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
		$('.selectpicker').selectpicker({
			noneSelectedText: 'Pilih Kategori',
			size: '4',
			// virtualScroll: '2',
		});
		let name=$("[name='name']").val();
		let email=$("[name='email']").val();
		let image_src=$('.edit-userimg').attr('src');
		console.log(image_src);
		$('.edit-profile').click(function(e){
			$(this).toggleClass("btn-batal-edit");
			$(this).toggleClass("btn-danger");
			$(".input").toggleClass("disabled");
			if($(".input").hasClass("disabled")){
				$(".input").attr('disabled',"disabled");
				$(".edit-userimg-btn").css('cursor','');
				$(".edit-userimg-btn").attr('for','');
				$(this).html("Edit Profile");
				$("[name='name']").val(name);
				$("[name='email']").val(email);
				$('.edit-userimg').attr('src',image_src);
			}else{
				$(".input").removeAttr('disabled','disabled');
				$(".edit-userimg-btn").css('cursor','pointer');
				$(".edit-userimg-btn").attr('for','upload-photo');
				$(this).html("Batal Edit");
			}
		});
		$("[name='profile_image'").change(function(e){
			loadFile(e);
		});
		var loadFile = function(event) {
			var image = $('.edit-userimg');
			image.attr('src',URL.createObjectURL(event.target.files[0]));
			console.log($('#upload-photo').val());
		};
	});
</script>
@endsection