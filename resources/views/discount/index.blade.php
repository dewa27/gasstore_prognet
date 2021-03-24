@extends('layouts.adminmaster')
@section('title')
Produk
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
                        <h4>Daftar Diskon</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/discounts/create" class="btn btn-primary text-light">
                            <i class="fas fa-plus-circle"></i>
                            Tambahkan Diskon Baru
                        </a>
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
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Asli</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Harga Diskon</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                            @if(!is_null($discount->product))
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$discount->product->product_name}}</td>
                                <td>{{$discount->product->price}}</td>
                                <td>{{$discount->percentage}}%</td>
                                <td>{{$discount->product->price*(100-$discount->percentage)/100}}</td>
                                <td>{{$discount->start}}</td>
                                <td>{{$discount->end}}</td>
                                <td>
                                    <button id="{{$discount->id}}" onclick="sendId(this.id)" type="button"
                                        class="btn btn-danger text-light" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
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
    function sendId(id) {
        document.getElementById('delForm').setAttribute('action', `/admin/discount/${id}/delete`);
    }
</script>
@endsection