@extends('layouts.adminmaster')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
<style>
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

                </div><!-- /.card-header -->
                <div class="card-body text-center">
                    <div class="mb-5">
                        <h4>Laporan Transaksi per Tahun</h4>
                        <canvas class="mx-auto" id="myChart" width="600" height="300"></canvas>
                    </div>
                    <div>
                        <h4>Laporan Transaksi 5 Tahun Terakhir</h4>
                        <canvas class="mx-auto" id="myChart2" width="600" height="300"></canvas>
                    </div>
                </div><!-- /.card-body -->
            </div>
            <div></div>
        </section>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('title')
Products
@endsection
@section('script')

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
{{-- var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013"],
            datasets: [{
                label: 'Dataset 1',
                data: [150, 200, 250, 150],
                color: "#878BB6",
            }, {
                label: 'Dataset 2',
                data: [250, 100, 150, 10],
                color: "#4ACAB4",
            }]
        }
    }); --}}
<script>
    $(function() {
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
        var data = {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober','November','Desember'],
                datasets: [{
                    label: 'Transaksi Sukses',
                    data: {!! json_encode($data_sukses_per_tahun) !!},
                    backgroundColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Sedang Berlangsung',
                    data: {!! json_encode($data_ongoing_per_tahun) !!},
                    backgroundColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Dibatalkan',
                    data: {!! json_encode($data_cancel_per_tahun) !!},
                    backgroundColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks:{
                            stepSize:10,
                            count:5,
                            precision:0,
                        },
                        suggestedMax:30,
                    }
                },
                legend: {
                    onClick: function (e) {
                        e.stopPropagation();
                    }
                }
            }
        };
        var ctx = document.getElementById('myChart').getContext('2d');
        var mychart = new Chart(ctx,data);
        var data2 = {
            type: 'line',
            data: {
                labels: ['2017','2018','2019','2020','2021'],
                datasets: [{
                    label: 'Transaksi Sukses',
                    data: {!! json_encode($data_penjualan_sukses_5_tahun)!!},
                    backgroundColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Sedang Berlangsung',
                    data: {!! json_encode($data_penjualan_ongoing_5_tahun)!!},
                    backgroundColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Dibatalkan',
                    data: {!! json_encode($data_penjualan_cancel_5_tahun)!!},
                    backgroundColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks:{
                            stepSize:10,
                            count:5,
                            precision:0,
                        },
                        suggestedMax:30,
                    }
                },
                legend: {
                    onClick: function (e) {
                        e.stopPropagation();
                    }
                }
            }
        };
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var mychart2 = new Chart(ctx2,data2);
        $('.selectpicker').selectpicker({
            noneSelectedText: 'Pilih Kategori'
        });
    });
</script>
@endsection