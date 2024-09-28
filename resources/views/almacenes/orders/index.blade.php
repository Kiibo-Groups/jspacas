@extends('layouts.app')
@section('title')
    Ordenes
@endsection
@section('page_active')
    Ordenes
@endsection
@section('subpage_active')
    Listado
@endsection

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
                        <div class="col-md-6" style="text-align: right;"></div>
                    </div>

                    <div class="card-body pt-3">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Productos</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="text-align: right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $row->products->count() }}</td>
                                        <td>${{ number_format($row->total_price, 2) }}</td>
                                        <td>${{ number_format($row->total_price, 2) }}</td>
                                        <td>${{ number_format($row->total_price, 2) }}</td>
                                        <td>
                                            @if ($row->status == 1)
                                                <button type="button"
                                                    class="btn btn-xs btn-soft-success waves-effect waves-light"
                                                    onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">Pagado</button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-xs btn-soft-danger waves-effect waves-light"
                                                    onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">Pendiente</button>
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
                                                        <a href="#" class="dropdown-item">
                                                            Imprimir
                                                        </a>
                                                    </li>
                                                    <!-- Print -->
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
