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
                        <h4>Buat Kategori Baru</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/categories" class="btn btn-primary text-light">
                            <i class="fas fa-arrow-circle-left"></i>
                            Kembali ke Daftar Kategori
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form id="createForm" method="post" action="/admin/categories/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input value="{{old('category_name')}}" name="category_name" type="name" class="form-control @error('category_name') is-invalid @enderror" id="category_name" placeholder="Ex:Elektronik,Pakaian">
                            @error('category_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </form>
                    <div class="card-footer">
                        <button value="submit" class="btn btn-success" type="submit" form="createForm">Buat Kategori</button>
                    </div>
                </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Products
@endsection