

@extends('layouts.layout-admin')

@section('content-side')

    <div id="layoutSidenav_content">
        <main>
            <center><h1 class="mt-4">PISANG</h1></center>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List Pisang
                        
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label>
                                <div class="col-sm-12 col-md-6">
                                    <p>
                                    <a href="/addpisang"><button type="button" class="btn btn-outline-primary" >Tambah</button></a>
                                    
                                    </p>
                                </div>
                            </label>
                        </div>
                        <div class="table-responsive">
                            <p>Ketikan sesuatu untuk melakukan filter pada table berdasarkan nama atau jenis atau grade pisang:</p>  
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pisang</th>
                                        <th>Jenis Pisang</th>
                                        <th>Grade Pisang</th>
                                        <th>Stock</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pisang</th>
                                        <th>Jenis Pisang</th>
                                        <th>Grade Pisang</th>
                                        <th>Stock</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody id="myTable">
                                    
                                        <tr>
                                            <td>a</td>
                                            <td>s</td>
                                            <td>d</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>
                                                <form class="text-right" method="GET">
                                                    {{ csrf_field() }}
                                                    <button type="button" class="btn btn-outline-danger" onclick="location.href='/'">Delete</button> 
                                                    <button type="button" class="btn btn-outline-success" onclick="location.href='/'">Update</button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>

@endsection


{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-light">Admin Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
