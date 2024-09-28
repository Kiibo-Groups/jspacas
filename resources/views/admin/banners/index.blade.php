@extends('layouts.admin')
@section('title') Gestor de Anuncios @endsection
@section('page_active') Anuncios @endsection 
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
                    <div class="col-md-6" style="text-align: right;"><a href="{{ route('admin.banners.create') }}"
                        class="btn btn-success rounded-pill waves-effect waves-light" style=" margin-right:20px" >Agregar
                            Anuncio</a>&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="card-body pt-3">
                 
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Imagen</th>
                                <th>Posición</th>
                                <th>Titulo</th>
                                <th>Subtitulo</th>
                                <th>Descripción</th>
                                <th>Status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td width="5%">
                                        <img src="{{ asset('upload/banner/'.$row->img) }}"
                                            style="width:50px;height: 50px;max-width:none !important;">
                                    </td>
                                    <td>
                                        @if ($row->position == 0)
                                            <h4 class="badge badge-soft-success">Principal</h4>
                                        @elseif($row->position == 1)
                                            <h4 class="badge badge-soft-info">Otro</h4>
                                        @endif
                                    </td>
                                    <td >{{ $row->title }}</td>
                                    <td >{{ $row->subtitle }}</td>
                                    <td >{{ $row->descript }}</td>
                                    <td >
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
                                        <div class="btn-group dropdown mb-2" role="group"> 
                                            <button class="btn btn-primary" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Opciones
                                                &nbsp;
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button> 

                                            <ul class="dropdown-menu"
                                                style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(0px, 38px);"
                                                data-popper-placement="bottom-start">
                                                <li>
                                                    <a href="{{ Asset($link .'/'. $row->id . '/edit') }}"
                                                        class="dropdown-item">
                                                        Editar
                                                    </a>
                                                </li>
                                                <!-- Delete -->
                                                <li>
                                                    <a href="javascript::void()" class="dropdown-item"
                                                        onclick="deleteConfirm('{{ Asset($link . '/delete/' . $row->id) }}')">
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
 