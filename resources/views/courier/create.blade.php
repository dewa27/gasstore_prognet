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
                        <h4>Tambahkan Kurir Baru</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/couriers" class="btn btn-primary text-light">
                            <i class="fas fa-arrow-circle-left"></i>
                            Kembali ke Daftar Kurir
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form id="createForm" method="post" action="/admin/couriers/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="courier">Nama Kurir</label>
                            <input value="{{old('courier')}}" name="courier" type="name" class="form-control @error('courier') is-invalid @enderror" id="courier" placeholder="Ex:Elektronik,Pakaian">
                            @error('courier')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </form>
                    <div class="card-footer">
                        <button value="submit" class="btn btn-success" type="submit" form="createForm">Tambahkan Kurir</button>
                    </div>
                </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Products
@endsection