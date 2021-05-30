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
                    <li class="mb-2 py-2 white-border"><a class="side-nav" href="">Edit Profile</a></li>
                    <li class="mb-2 py-2 white-border"><a class="side-nav" href="">Reset Password</a></li>
                </ul>
            </div>
            <div class="col-md-9 p-4 card-style position-relative">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="font-weight-bold mb-0">Email</label>


                        <input id="email" type="email"
                            class="fonted bg-transparent text-white form-control form-control-underlined py-0 @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold mb-0">{{ __('Password') }}</label>

                        <input id="password" type="password"
                            class="fonted bg-transparent text-white form-control form-control-underlined py-0  @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="font-weight-bold mb-0">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password"
                            class="form-control fonted bg-transparent text-white form-control form-control-underlined py-0"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button id="submit" type="submit" class="bg-dark btn text-light w-100">Reset Password</button>
                </form>
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
	});
</script>
@endsection