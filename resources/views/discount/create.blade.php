@extends('layouts.adminmaster')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
    integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
    crossorigin="anonymous"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
    integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
    crossorigin="anonymous" />
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
                        <h4>Tambahkan Diskon Baru</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/products" class="btn btn-primary text-light">
                            <i class="fas fa-arrow-circle-left"></i>
                            Kembali ke Daftar Diskon
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form id="createForm" method="post" enctype="multipart/form-data" action="/admin/discounts/store">
                        @csrf
                        <div class="form-group">
                            <label for="percentage">Persentase Diskon</label>
                            <div class="input-group">
                                <input value="{{old('percentage')}}" name="percentage" type="name"
                                    class="form-control @error('percentage') is-invalid @enderror" id="percentage"
                                    placeholder="Ex:30">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                                @error('percentage')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Produk</label>
                            <select name="product_id"
                                class="form-control selectpicker @error('product_id') is-invalid @enderror"
                                id="select-product" data-live-search="true">
                                <option selected disabled value="0">Pilih Produk</option>
                                @foreach($products as $product)
                                <option value=" {{$product->id}}" data-tokens="{{$product->product_name}}">
                                    {{$product->id}} - {{$product->product_name}}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="start">Mulai</label>
                            <input value="{{old('start')}}" name="start" type="date"
                                class="form-control @error('start') is-invalid @enderror" id="start"
                                placeholder="Ex:10200000">
                            @error('start')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="end">Akhir</label>
                            <input value="{{old('end')}}" name="end" type="date"
                                class="form-control @error('end') is-invalid @enderror" id="end"
                                placeholder="Ex:10200000">
                            @error('end')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </form>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <button value="submit" class="btn btn-success" type="submit" form="createForm">Buat Produk</button>
                </div>
            </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Products
@endsection
@section('script')
@endsection