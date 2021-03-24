@extends('layouts.adminmaster')
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
                        <h4>Detail Kategori</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/categories" class="btn btn-primary text-light">
                            <i class="fas fa-arrow-circle-left"></i>
                            Kembali ke Daftar Kategori
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
                    <h5>{{$product_category->category_name}}</h5>
                    <p></p>

                </div><!-- /.card-body -->
            </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Detail Kategori
@endsection