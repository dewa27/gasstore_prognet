@extends('layouts.adminmaster')
@section('head')
<style>
    .tag {
        font-size: 12px !important;
        border-radius: 15px !important;
        background-color: #f2f1f1 !important;
        color: #544e4e;
    }

    .uploaded-images {
        width: 100%;
        margin-bottom: 20px;
    }

    .btn-delete {
        position: absolute;
        top: 0;
        left: 15px;
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
                            <a href="/admin/products" class="btn btn-primary text-light">
                                <i class="fas fa-arrow-circle-left"></i>
                                Kembali ke Daftar Produk
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
                    <form id="editForm" method="post" enctype="multipart/form-data"
                        action="/admin/products/{{$product->id}}/update">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input value="{{old('product_name') ?? $product->product_name}}" name="product_name"
                                type="name" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" placeholder="Ex:LAPTOP ASUS A412DA - RYZEN 5 3500U 8GB 512GB SSD">
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
                                <input value="{{old('price') ?? $product->price}}" name="price" type="name"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="Ex:10200000">
                            </div>
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="description" rows="3"
                                placeholder="Ex:Laptop bagus untuk anak kuliah blablabla">{{old('description') ?? $product->description}}</textarea>
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
                                <option class="categories" value="{{$category->id}}"
                                    data-tokens="{{$category->category_name}}">{{$category->category_name}}</option>
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
                            <input value="{{old('stock') ?? $product->stock}}" name="stock" type="name"
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
                                <input value="{{old('weight') ?? $product->weight}}" name="weight" type="name"
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
                            <label for="product_images">Tambah Foto Produk</label>
                            <input multiple type="file"
                                class="form-control-file @error('product_images') is-invalid @enderror"
                                id="product_images" name="product_images[]">
                            @error('product_images')
                            <input type="">
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="container-fluid">
                            {{-- <p>Foto Produk</p> --}}
                            <div class="db-photo row">
                                @foreach($product->images as $img)
                                <div class="col-md-6 position-relative">
                                    <img class="uploaded-images" src="{{asset('images/products/'.$img->image_name)}}"
                                        alt="">
                                    <button id="{{$img->id}}" type="button"
                                        class="btn btn-danger text-light btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <p>Foto Baru :</p>
                            <div class="up-photo row">
                            </div>
                        </div>
                        <input type="hidden" id="delImg" name="deletedImagesId">
                    </form>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <button value="submit" class="btn btn-success" type="submit" form="editForm">Simpan Produk</button>
                </div>
            </div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Detail Produk
@endsection
@section('script')
<script>
    $(function() {
        var rupiah = document.getElementById("price");
        rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
        let deletedImages=[];
        let selectedCategories = [];
        $.each(@json($product->categories), function(index, value) {
            selectedCategories.push(value.id);
        });
        let allCategories = $('.categories');
        console.log(selectedCategories);
        $.each(allCategories, function(index, value) {
            if ($.inArray(parseInt(value.value), selectedCategories) >= 0) {
                value.setAttribute("selected", "selected");
            }
        });
        $('.selectpicker').selectpicker({
            noneSelectedText: 'Pilih Kategori'
        });
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
        $('.btn-delete').on('click',function(){
            deletedImages.push($(this).attr('id'));
            $(this).parent().remove();
            $('#delImg').attr('value',deletedImages.join());
        });
        // let base_path = "{{url('/')}}";
        // let link=`${base_path}/admin/products/{{$product->id}}/update`;
        // console.log(link);
        // $('#editForm').submit(function(){
        //     $.ajax({
        //         url: link,
        //         method: "POST",
        //         data:
        //         {
        //             delmage: deletedImages,
        //         },
        //         headers: 
        //         {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success:function(data){
        //             console.log("yoo");
        //         }
        //     });
        // });
    });
</script>
@endsection