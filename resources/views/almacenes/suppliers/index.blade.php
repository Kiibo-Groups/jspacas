@extends('layouts.app')
@section('title') Proveedores Registrados @endsection
@section('page_active') Proveedores @endsection 
@section('subpage_active') Listado @endsection 


@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card py-3">

                <div class="row">
                    <div class="col-md-6" style="text-align: left;">
                        <b style="margin-left:20px">@yield('page_active') | @yield('subpage_active')</b>
                    </div>
                    <div class="col-md-6" style="text-align: right;"><a href="{{ Asset($link . 'create') }}"
                        class="btn btn-success rounded-pill waves-effect waves-light" style=" margin-right:20px" >Agregar
                        Proveedor</a>&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="card-body pt-3">
                 
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Nombre</th> 
                                <th>Status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td width="5%">
                                        <img src="{{ asset('upload/suppliers/logo/'.$row->logo) }}"
                                            style="height: 50px;">
                                    </td>
                                    <td>{{ $row->name }}</td>  
                                    <td>
                                        @if ($row->status == 1)
                                            <button type="button"  class="btn btn-xs btn-soft-success waves-effect waves-light"
                                                onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">Activo</button>
                                        @else
                                            <button type="button"
                                            class="btn btn-xs btn-soft-danger waves-effect waves-light"
                                                onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">Inactivo</button>
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        <div class="btn-group" role="group">

                                        <button class="btn btn-xs btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </button>

                                        <ul class="dropdown-menu"
                                            style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(0px, 38px);"
                                            data-popper-placement="bottom-start">
                                            <li>
                                                <a href="{{ Asset($link . $row->id.'/edit') }}" class="dropdown-item">
                                                    Editar
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript::void()" class="dropdown-item"
                                                    onclick="deleteConfirm('{{ Asset($link .'delete/' . $row->id) }}')">
                                                    Eliminar
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
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
 