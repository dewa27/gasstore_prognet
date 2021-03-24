@extends('layouts.adminmaster')
@section('head')
<style>
    .tag {
        font-size: 12px !important;
        border-radius: 15px !important;
        background-color: #f2f1f1 !important;
        color: #544e4e;
    }

    /*--- Pake carousel bootstrap--- */
    /* .carousel {
        height: 350px;
        margin-bottom: 60px;
        background-image: linear-gradient(to right, #454444, #4a4848, #4f4b4b, #554f4f, #5a5353, #5a5353, #5a5353, #5a5353, #554f4f, #4f4b4b, #4a4848, #454444);
        border-radius: 20px;
    }

    .no-photo {
        height: 100px;
        margin-bottom: 15px;
        background-image: linear-gradient(to right, #d7d6d6, #dad9da, #dddddd, #e1e1e1, #e4e4e4, #e4e4e4, #e4e4e4, #e4e4e4, #e1e1e1, #dddddd, #dad9da, #d7d6d6);
        border-radius: 20px;
    }

    .no-photo>h3 {
        line-height: 100px;
        color: #A2A2A2;
    }

    .carousel-inner>.carousel-item>img {
        height: 350px;
        width: auto;
        margin: 0 auto;
    } */
    /* ---Pake carousel OwlCarousel2--- */
    .owl-nav span {
        font-size: 30px !important;
    }
</style>
@endsection
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-content-center">
                        <h4>Detail Produk</h4>
                        <div>
                            <a href="/admin/products/{{$product->id}}/edit" class="mr-1 btn btn-success text-light">
                                <i class="fas fa-edit"></i>
                                Ubah Produk
                            </a>
                            <a href="/admin/products" class="btn btn-primary text-light">
                                <i class="fas fa-arrow-circle-left"></i>
                                Kembali ke Daftar Produk
                            </a>
                        </div>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <h5>{{$product->product_name}}</h5>
                    @if(count($product->categories))
                    @foreach($product->categories as $category)
                    <p class="d-inline-block tag px-2 py-1">{{$category->category_name}}</p>
                    @endforeach
                    @endif
                    @if(count($product->images))
                    <div class="owl-carousel owl-theme mx-auto w-75">
                        @foreach($product->images as $image)
                        <div class="item"> <img class="" src="{{asset('images/products/'.$image->image_name)}}"
                                alt="First slide"></div>
                        @endforeach
                    </div>
                    {{-- <div id="carouselExampleIndicators" class="w-100 carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($product->images as $image)
                            @if($loop->index==0)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"
                    class="active"></li>
                    @else
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"></li>
                    @endif
                    @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($product->images as $image)
                        @if($loop->index==0)
                        <div class="carousel-item active">
                            <img class="d-block" src="{{asset('images/products/'.$image->image_name)}}"
                                alt="First slide">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img class="d-block" src="{{asset('images/products/'.$image->image_name)}}"
                                alt="First slide">
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> --}}
                @else
                <div class="no-photo">
                    <h3 class="text-center">Tidak ada foto</h3>
                </div>
                @endif
                <table class="table">
                    <tbody>
                        <tr class="d-flex">
                            <th class="col-4" scope="row">Stok</th>
                            <td class="col-8">{{$product->stock}}</td>
                        </tr>
                        <tr class="d-flex">
                            <th class="col-4" scope="row">Berat</th>
                            <td class="col-8">{{$product->weight}}</td>
                        </tr>
                        <tr class="d-flex">
                            <th class="col-4" scope="row">Deskripsi</th>
                            <td class="col-8">{{$product->description}}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
    </div>
    </section>
</div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Detail Produk
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin:10,
            nav:true,
            items:1,
            // autoHeight:true,
            loop:true,
        });
        // $('#carouselExampleIndicators').carousel();
    });
</script>
@endsection