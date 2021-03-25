@extends('layouts.adminmaster')
@section('title')
Produk
@endsection
@section('head')
<style>
    .form-control::placeholder {
        font-size: 0.95rem;
        color: #aaa;
        font-style: italic;
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
</style>
@endsection
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <?php /* 
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    */ ?>
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-content-center">
                        <h4>Daftar Produk</h4>
                        <!-- Button trigger modal -->
                        <div>
                            <a href="/admin/products/create" class="btn btn-primary text-light">
                                <i class="fas fa-plus-circle"></i>
                                Tambahkan Produk Baru
                            </a>
                            <a href="/admin/products/trashed" class="btn btn-danger text-light">
                                <i class="fas fa-dumpster"></i>
                                Sampah
                            </a>
                        </div>
                    </div>
                    <!-- <div class=" card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                    </div> -->
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped">
                        <form action="/admin/products/search" id="searchForm">
                            <div class="p-1 bg-light rounded-pill shadow-sm mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="button-addon2" value="submit" form="searchForm" type="submit"
                                            class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input id="search" type="search" placeholder="Cari nama produk..." name="keyword"
                                        aria-describedby="button-addon2" class="form-control border-0 bg-light">
                                </div>
                            </div>
                            <select multiple data-style="bg-light rounded-pill px-4 py-3 shadow-sm "
                                class="selectpicker w-25" id="category" name="category_id[]">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" data-tokens="{{$category->category_name}}">
                                    {{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" form="searchForm"
                                class="bg-light btn rounded-pill ml-2 px-3 py-2">Terapkan
                                Filter</button>
                        </form>
                        <thead>
                            <tr>
                                <th scope=" col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="displayData">
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$product->product_name}}</td>
                                <td>Rp.{{number_format($product->price,0,',','.')}}</td>
                                <td>{{$product->stock}}</td>
                                <td>
                                    <a href="products/{{$product->id}}/detail" class="btn btn-success text-light">
                                        <i class="fas fa-info-circle"></i>
                                        Detail
                                    </a>
                                    <button id="{{$product->id}}" type="button"
                                        class="del-button btn btn-danger text-light" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
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
<script>
    $(function(){

        $('.selectpicker').selectpicker({
            noneSelectedText: 'Filter by Kategori'
        });
        $('.del-button').click(function(){
            $('#delForm').attr('action',`/admin/products/${$(this).attr('id')}/delete`);
        });
        var base_path = "{{url('/')}}";
        let result;
        // function displayData(data){
        //     $('#displayData').html('');
        //     $('#no-result').remove();
        //     // console.log(data);
        //     $.each(data, function(index, val) {
        //         let item = `<tr>
        //                 <th scope="row">${index+1}</th>
        //                 <td>${val.product_name}</td>
        //                 <td>Rp.${val.price}</td>
        //                 <td>${val.stock}</td>
        //                 <td>
        //                     <a href="products/${val.id}/detail" class="btn btn-success text-light">
        //                         <i class="fas fa-info-circle"></i>
        //                         Detail
        //                     </a>
        //                     <button id="${val.id}" onclick="sendId(this.id)" type="button" class="btn btn-danger text-light" data-toggle="modal" data-target="#exampleModal">
        //                         <i class="fas fa-trash"></i>
        //                         Delete
        //                     </button>
        //                 </td>
        //             </tr>`;
        //         // console.log(val);
        //         $('#displayData').append(item);
        //     });
        // }

        $('#searchForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: `${base_path}/admin/products/search`,
                dataType: "json",
                data: {
                    "keyword": $('#search').val(),
                    "category_id":$('#category').val(),
                },
                success: function(data) {
                    if (jQuery.isEmptyObject(data)) {
                        $('#displayData').html('');
                        if (!$('#no-result').length) {
                            $('.card-body').append("<h4 id='no-result' class='mt-2 text-center'>Tidak ada hasil</h4>");
                        }
                    } else {
                        // result=data;
                        // console.log(result);
                        // displayData(data[0]);
                        console.log(data);
                        $('#displayData').html('');
                        $('#no-result').remove();
                        // console.log(data);
                        $.each(data, function(index, val) {
                            let item = `<tr>
                                    <th scope="row">${index+1}</th>
                                    <td>${val.product_name}</td>
                                    <td>Rp.${val.price}</td>
                                    <td>${val.stock}</td>
                                    <td>
                                        <a href="products/${val.id}/detail" class="btn btn-success text-light">
                                            <i class="fas fa-info-circle"></i>
                                            Detail
                                        </a>
                                        <button id="${val.id}" onclick="sendId(this.id)" type="button" class="btn btn-danger text-light" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>`;
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