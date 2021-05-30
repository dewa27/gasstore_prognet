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
                        <h4>Daftar Transaksi</h4>
                        <!-- Button trigger modal -->
                        {{-- <a href="/admin/products/create" class="btn btn-primary text-light">
                            <i class="fas fa-plus-circle"></i>
                            Tambahkan Produk Baru
                        </a> --}}
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    {{-- <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#unverified">Unverified</a></li>
                        <li><a data-toggle="tab" href="#verified">Verified</a></li>
                        <li><a data-toggle="tab" href="#delivered">Delivered</a></li>
                        <li><a data-toggle="tab" href="#success">Success</a></li>
                        <li><a data-toggle="tab" href="#expired">Expired</a></li>
                        <li><a data-toggle="tab" href="#canceled">Canceled</a></li>
                    </ul> --}}
                    <ul class="nav nav-pills mb-4">
                        <li role="presentation" class="nav-item active">
                            <a data-toggle="tab" href="#all" class="nav-link active">All</a>
                        </li>
                        <li role="presentation" class="nav-item active">
                            <a data-toggle="tab" href="#unverified" class="nav-link">Unverified</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a data-toggle="tab" href="#verified" class="nav-link">Verified</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a data-toggle="tab" href="#delivered" class="nav-link">Delivered</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a data-toggle="tab" href="#success" class="nav-link">Success</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a data-toggle="tab" href="#expired" class="nav-link">Expired</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a data-toggle="tab" href="#canceled" class="nav-link">Canceled</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="all" class="tab-pane fade show active" role="tabpanel">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="unverified" class="tab-pane fade show" role="tabpanel">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','unverified')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="verified" role="tabpanel" class="tab-pane fade">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','verified')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="delivered" role="tabpanel" class="tab-pane fade">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','delivered')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="success" role="tabpanel" class="tab-pane fade">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','success')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="expired" role="tabpanel" class="tab-pane fade">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','expired')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="canceled" role="tabpanel" class="tab-pane fade">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pembeli</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th>Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="displayData">
                                    @foreach($transactions->where('status','canceled')->all() as $transaction)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->address}}</td>
                                        <td>{{number_format($transaction->total,0,',','.')}}</td>
                                        <td>{{Str::upper($transaction->status)}}</td>
                                        <td>
                                            <a href="/admin/transactions/{{$transaction->id}}/detail"
                                                class="btn btn-success text-light">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                <h5 class="modal-title">Hapus Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
            </div>
            <div class="modal-footer">
                <form id="delForm" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
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
        function sendId(id) {
            document.getElementById('delForm').setAttribute('action', `/admin/products/${id}/delete`);
        }
        var base_path = "{{url('/')}}";
        // $('#searchForm').submit(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: "GET",
        //         url: `${base_path}/admin/products/search`,
        //         dataType: "json",
        //         data: {
        //             "keyword": $('#search').val(),
        //             "category_id":$('#category').val(),
        //         },
        //         success: function(data) {
        //             if (jQuery.isEmptyObject(data)) {
        //                 $('#displayData').html('');
        //                 if (!$('#no-result').length) {
        //                     $('.card-body').append("<h4 id='no-result' class='mt-2 text-center'>Tidak ada hasil</h4>");
        //                 }
        //             } else {
        //                 $('#displayData').html('');
        //                 $('#no-result').remove();
        //                 // console.log(data);
        //                 $.each(data, function(index, val) {
        //                     let item = `<tr>
        //                             <th scope="row">${index+1}</th>
        //                             <td>${val.product_name}</td>
        //                             <td>Rp.${val.price}</td>
        //                             <td>${val.stock}</td>
        //                             <td>
        //                                 <a href="products/${val.id}/detail" class="btn btn-success text-light">
        //                                     <i class="fas fa-info-circle"></i>
        //                                     Detail
        //                                 </a>
        //                                 <button id="${val.id}" onclick="sendId(this.id)" type="button" class="btn btn-danger text-light" data-toggle="modal" data-target="#exampleModal">
        //                                     <i class="fas fa-trash"></i>
        //                                     Delete
        //                                 </button>
        //                             </td>
        //                         </tr>`;
        //                     // console.log(val);
        //                     $('#displayData').append(item);
        //                 });
        //             }
        //         }
        //     });
        // });
    });
</script>
@endsection