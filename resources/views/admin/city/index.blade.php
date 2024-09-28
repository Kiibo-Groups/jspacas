@extends('layouts.admin')
@section('title') Listado de ciudades @endsection
@section('page_active') Ciudades @endsection 
@section('subpage_active') Listado @endsection 


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card py-3">

                <div class="row">
                    <div class="col-md-6" style="text-align: left;">
                        <b style="margin-left:20px">@yield('page_active') | @yield('subpage_active')</b>
                    </div>
                    <div class="col-md-6" style="text-align: right;"><a href="{{ route('admin.city.create') }}"
                        class="btn btn-success rounded-pill waves-effect waves-light" style=" margin-right:20px" >Agregar
                            Ciudad</a>&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="card-body pt-3">
                 
                    <table class="table table-hover ">
                        <thead>
                            <tr> 
                                <th>Nombre</th>
                                <th>Status</th>
                                <th>Opciones</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        @if ($row->status == 0)
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
                                                <a href="{{ Asset($link . $row->id . '/edit') }}"
                                                    class="dropdown-item">
                                                    Editar
                                                </a>
                                            </li>
                                            <!-- Delete -->
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