@extends('layouts.app')

@section('title') Gestión de Productos @endsection
@section('breadcrumb') Productos @endsection

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card py-3 m-b-30">

                <div class="row">
                    <div class="col-md-12" style="text-align: right;"><a href="{{ Asset('/add_product') }}" class="btn m-b-15 ml-2 mr-2 btn-rounded btn-success">Agregar Producto</a>&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="card-body py-3 m-b-30" style="padding-top: 25px">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Código Sat</th>
                                <th>Nombre</th> 
                                <th>Código de la Unidad</th>
                                <th>Unidad</th> 
                                <th>Precio</th> 
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($data->data as $row)
                            <tr>
                                <td>{{ $row->unit_key }}</td>
                                <td>{{ $row->description }}</td> 
                                <td>{{ $row->unit_name }}</td>
                                <td>{{ $row->unit_key }}</td>
                                <td>{{ $row->price }}</td>
                                <td>
                                    <a href="javascript::void()" class="btn btn-danger" onclick="deleteConfirm('{{ Asset($link.'delete/'.$row->id) }}')">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </a>
                                </td>
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