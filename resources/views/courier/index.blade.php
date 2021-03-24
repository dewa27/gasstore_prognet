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
                        <h4>Kurir</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/couriers/create" class="btn btn-primary text-light">
                            <i class="fas fa-plus-circle"></i>
                            Tambahkan Kurir Baru
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
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($couriers as $courier)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$courier->courier}}</td>
                                <td>
                                    <a href="/admin/couriers/{{$courier->id}}/detail" class="btn btn-success text-light">
                                        <i class="fas fa-info-circle"></i>
                                        Detail
                                    </a>
                                    <button id="{{$courier->id}}" onclick="sendId(this.id)" type="button" class="btn btn-danger text-light" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Kurir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
            </div>
            <div class="modal-footer">
                <form id="delForm" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus Kurir</button>
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
        document.getElementById('delForm').setAttribute('action', `/admin/couriers/${id}/delete`);
    }
</script>
@endsection