@extends('layouts.adminmaster')
@section('head')
<style>
    .tag {
        font-size: 12px !important;
        border-radius: 15px !important;
        background-color: #f2f1f1 !important;
        color: #544e4e;
    }

    .carousel {
        height: 350px;
        margin-bottom: 60px;
        background-image: linear-gradient(to right, #454444, #4a4848, #4f4b4b, #554f4f, #5a5353, #5a5353, #5a5353, #5a5353, #554f4f, #4f4b4b, #4a4848, #454444);
        border-radius: 20px;
    }

    .no-photo {
        height: 100px;
        margin-bottom: 15px;
        background-image: linear-gradient(to right, #d7d6d6, #dad9da, #dddddd, #e1e1e1, #e4e4e4, #e4e4e4, #e4e4e4, #e4e4e4, #e1e1e1, #dddddd, #dad9da, #d7d6d6);
        border-radius: 20px;
    }

    .no-photo>h3 {
        line-height: 100px;
        color: #A2A2A2;
    }

    .carousel-inner>.carousel-item>img {
        height: 350px;
        width: auto;
        margin: 0 auto;
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
                        <h4>Detail Transaksi</h4>
                        <div>
                            {{-- <a href="/admin/products/{{$product->id}}/edit" class="mr-1 btn btn-success
                            text-light">
                            <i class="fas fa-edit"></i>
                            Ubah Produk
                            </a> --}}
                            <a href="/admin/transactions" class="btn btn-primary text-light">
                                <i class="fas fa-arrow-circle-left"></i>
                                Kembali ke Daftar Transaksi
                            </a>
                            @if($transaction->status=="unverified")
                            <a style="pointer-events:none; background-color:orange"
                                class="btn text-light">Unverified</a>
                            @elseif($transaction->status=="verified")
                            <a style="pointer-events:none; background-color:blue" class="btn text-light">Verified</a>
                            @elseif($transaction->status=="delivered")
                            <a style="pointer-events:none; background-color:yellow" class="btn text-dark">Delivered</a>
                            @endif
                        </div>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body container">
                    <div class="row">
                        <div class="col-md-7">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="pr-4">Nama Pembeli</th>
                                        <td>{{$transaction->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Provinsi</th>
                                        <td>{{$transaction->province}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Kota/Kabupaten</th>
                                        <td>{{$transaction->regency}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Alamat</th>
                                        <td>{{$transaction->address}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Biaya Pengiriman</th>
                                        <td>Rp {{number_format($transaction->shipping_cost,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Total Harga Barang</th>
                                        <td>Rp {{number_format($transaction->sub_total,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-4">Total Bayar</th>
                                        <td>Rp {{number_format($transaction->total,0,',','.')}}</td>
                                    </tr>
                                    <tr class="mt-5">
                                        <th class="pr-4">Status</th>
                                        <td>{{$transaction->status}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <div class="text-center">
                                <h5>Bukti Transfer</h5>
                                <img class="w-100 mb-2" src="/images/verif/{{$transaction->proof_of_payment}}" alt="">
                                <form method="POST" id="changeStatus" action="/admin/transaction/update-status">
                                    @csrf
                                    <input name="id" type="hidden" value="{{$transaction->id}}">
                                    @if ($transaction->status=="unverified" && $transaction->proof_of_payment!=null)
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" class="btn btn-success"> <i
                                            class="fa fa-refresh mr-2"></i>Approve
                                        Bukti
                                        Pembayaran</button>
                                    @elseif($transaction->status=="verified")
                                    <input type="hidden" name="status" value="delivered">
                                    <button type="submit" class="btn btn-success"> <i
                                            class="fa fa-refresh mr-2"></i>Update
                                        Status ke
                                        Delivered</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center">Detail Produk</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Berat</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->detail_transaksi as $item)
                            <tr>
                                <td><a
                                        href="/admin/products/{{$item->product_id}}/detail">{{$item->product->product_name}}</a>
                                </td>
                                <td>{{$item->product->weight}} gram</td>
                                <td>{{$item->qty}}</td>
                                <td>{{number_format($item->selling_price,0,',','.')}}</td>
                                <td>{{$item->discount}}%</td>
                                <td>Rp {{number_format($item->selling_price * $item->qty,0,',','.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div>
        </section>
    </div>
</div>
@endsection
@section('title')
Detail Produk
@endsection
@section('script')
<script>

</script>
@endsection