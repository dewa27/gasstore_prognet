@extends('layouts.adminmaster')
@section('head')
<style>
    p {
        margin: 0;
    }

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

    .reply-button {
        display: inline-block;
        cursor: pointer;
    }

    .user-review-star {
        color: #FDCC0D;
    }

    .user-review-star-black {
        color: black;
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
                <h3>Review</h3>
                @foreach ($product->reviews as $review)
                <div class="card">
                    <div id="{{$review->id}}" class="card-body">
                        <div class="d-flex">
                            <h5 class="reviewer-name mr-2">{{$review->user->name}}</h5>
                            <p class="font-weight-italic">{{$review->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="reviewer-stars">
                            @for ($i = 0; $i < $review->rate; $i++)
                                <span class="fa fa-star user-review-star"></span>
                                @endfor
                                @if ($review->rate < 5) @for ($i=0; $i < 5-$review->rate; $i++)
                                    <span class="fa fa-star user-review-star-black"></span>
                                    @endfor
                                    @endif
                        </div>
                        <p class="reviewer-content">{{$review->content}}</p>
                        <div class="text-right mb-2">
                            <p id="reply{{$review->id}}" class="reply-button reply mr-3">
                                Balas</p>
                            <p id="show-reply{{$review->id}}" class="reply-button show-reply">Lihat Balasan</p>
                        </div>
                        <div class="hidden-response" id="hidden{{$review->id}}">
                            @foreach ($review->responses as $response)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2">{{$response->admin->name}} (Admin)</p>
                                        <p class="font-weight-italic">{{$response->created_at->diffForHumans()}}</p>
                                    </div>
                                    <p>{{$response->content}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div><!-- /.card-body -->
        </section>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="mb-1">
                    <h5 id="review-name"></h5>
                    <div id="review-star"></div>
                    <p id="review-content"></p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="responseForm" action="/admin/product/review/response" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Ketik balasan untuk review di atas</label>
                        <input class="form-control" type="text" name="content">
                    </div>
                    <input type="hidden" name="review_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" value="submit" form="responseForm" class="btn btn-primary">Kirim Balasan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title')
Detail Produk
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.hidden-response').hide();
        $(".owl-carousel").owlCarousel({
            margin:10,
            nav:true,
            items:1,
            // autoHeight:true,
        });
        $('.reply').click(function(){
            var reviewid=parseInt($(this).attr('id').substring(5));
            $('#review-name').html($(`#${reviewid} .reviewer-name`).html());
            $('#review-star').html($(`#${reviewid} .reviewer-stars`).html());
            $('#review-content').html($(`#${reviewid} .reviewer-content`).html());
            $('[name="review_id"]').val(reviewid);
            $('#exampleModal').modal('show');
        });
        $('.show-reply').click(function(){
            var btn=$(this);
            var reviewid=parseInt($(this).attr('id').substring(10));
            $(`#hidden${reviewid}`).toggle(function(){
                if(($(this)).is(":hidden")){
                    btn.html('Lihat Balasan');
                }
                if(($(this)).is(":visible")){
                    btn.html('Tutup Balasan');
                }
            });
        });
        // $('#carouselExampleIndicators').carousel();
    });
</script>
@endsection