@extends('layouts.adminmaster')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
    integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
    crossorigin="anonymous"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
    integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
    crossorigin="anonymous" />
<style>
    .uploaded-images {
        width: 100%;
        margin-bottom: 20px;
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
                        <h4>Tambahkan Produk Baru</h4>
                        <!-- Button trigger modal -->
                        <a href="/admin/products" class="btn btn-primary text-light">
                            <i class="fas fa-arrow-circle-left"></i>
                            Kembali ke Daftar Produk
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form id="createForm" method="post" enctype="multipart/form-data" action="/admin/products/store">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input value="{{old('product_name')}}" name="product_name" type="name"
                                class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                                placeholder="Ex:LAPTOP ASUS A412DA - RYZEN 5 3500U 8GB 512GB SSD">
                            @error('product_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input value="{{old('price')}}" name="price" type="name"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="Ex:10200000">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea value="{{old('description')}}" name="description"
                                class="form-control @error('description') is-invalid @enderror" id="description"
                                rows="3" placeholder="Ex:Laptop bagus untuk anak kuliah blablabla"></textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_name">Kategori</label>
                            <select multiple name="category_id[]"
                                class="form-control selectpicker @error('category_id') is-invalid @enderror"
                                id="select-category" data-live-search="true">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" data-tokens="{{$category->category_name}}">
                                    {{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input value="{{old('stock')}}" name="stock" type="name"
                                class="form-control @error('stock') is-invalid @enderror" id="stock"
                                placeholder="Ex:25">
                            @error('stock')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="weight">Berat</label>
                            <div class="input-group">
                                <input value="{{old('weight')}}" name="weight" type="name"
                                    class="form-control @error('weight') is-invalid @enderror" id="weight"
                                    placeholder="Ex:1.4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">kg</div>
                                </div>
                                @error('weight')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_images">Unggah Foto Produk</label>
                            <input multiple type="file"
                                class="form-control-file @error('product_images') is-invalid @enderror"
                                id="product_images" name="product_images[]">
                            @error('product_images')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="container-fluid">
                            <div class="up-photo row">

                            </div>
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
<script>
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        let col=$($.parseHTML('<div>')).addClass('col-md-6').appendTo(placeToInsertImagePreview);
                        $($.parseHTML('<img>')).attr('src', event.target.result).addClass('uploaded-images').appendTo(col);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#product_images').on('change', function() {
            if($('.up-photo').is(':empty')){
                imagesPreview(this, 'div.up-photo');
            }else{
                $('.up-photo').html('');
                imagesPreview(this, 'div.up-photo');
            }
        });
        $('.selectpicker').selectpicker({
            noneSelectedText: 'Pilih Kategori'
        });
    });
</script>
@endsection