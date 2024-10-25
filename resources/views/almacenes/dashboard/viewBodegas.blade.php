@extends('layouts.app')
@section('title') Productos de {{ $almacen->name }} @endsection
@section('page_active') Productos de {{ $almacen->name }} @endsection 
@section('subpage_active') Listado @endsection 

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card py-3">

                <div class="row">
                    <div class="col-md-6" style="text-align: left;">
                        <b style="margin-left:20px">@yield('page_active') | @yield('subpage_active')</b>
                    </div>
                </div>

                <div class="card-body pt-3 table-responsive">
                 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th> 
                                <th>Precio</th>
                                <th>Stock</th> 
                            </tr> 
                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td width="10%">
                                        <img src="{{ asset('upload/products/'.$row->image) }}"
                                            style="height: 50px;max-width:50px;border-radius: 2003px !important;">
                                    </td>
                                    <td>{{ $row->name }}</td>  
                                    <td>${{ number_format($row->price,2) }}</td>
                                    <td>{{ $row->qty }}</td> 
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 