@extends('layouts.app')

@section('title') Gestión de Clientes @endsection
@section('breadcrumb') Clientes @endsection


@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card py-3 m-b-30">

                <div class="row">
                    <div class="col-md-12" style="text-align: right;"><a href="{{ Asset('/add_client') }}" class="btn m-b-15 ml-2 mr-2 btn-rounded btn-success">Agregar Cliente</a>&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="card-body py-3 m-b-30" style="padding-top: 25px">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Nombre / Razón Social</th>
                                <th>RFC</th>
                                <th>Régimen fiscal:</th> 
                                <th>E-Mail</th> 
                                <th>Telefono</th>
                                <th style="text-align: right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($data->data as $row)
                            <tr>
                                <td>{{ $row->legal_name }}</td>
                                <td>{{ $row->tax_id }}</td>
                                <td>
                                    @switch($row->tax_system)
                                        @case('601')
                                                {{ substr("601 - General de Ley Personas Morales",0,35) }}...
                                            @break
                                        @case('603')
                                            {{ substr("603 - Personas Morales con Fines no Lucrativos",0,35) }}...
                                            @break
                                        @case('605')
                                            {{ substr("605 - Sueldos y Salarios e Ingresos Asimilados a Salarios",0,35) }}...
                                            @break
                                        @case('606')
                                            {{ substr("606 - Arrendamiento",0,35) }}...
                                            @break
                                        @case('607')
                                                {{ substr("607 - Régimen de Enajenación o Adquisición de Bienes",0,35) }}...
                                            @break
                                        @case('608')
                                                {{ substr("608 - Demás ingresos",0,35) }}...
                                            @break
                                        @case('610')
                                            {{ substr("610 - Residentes en el Extranjero sin Establecimiento Permanente en México",0,35) }}...
                                            @break
                                        @case('611')
                                            {{ substr(" 611 - Ingresos por Dividendos (socios y accionistas)",0,35) }}...
                                            @break
                                        @case('612')
                                            {{ substr(" 612 - Personas Físicas con Actividades Empresariales y Profesionales",0,35) }}...
                                            @break
                                        @case('614')
                                                {{ substr("614 - Ingresos por intereses",0,35) }}...
                                            @break 
                                        @case('615')
                                            {{ substr("615 - Régimen de los ingresos por obtención de premios",0,35) }}...
                                            @break
                                        @case('616')
                                            {{ substr("616 - Sin obligaciones fiscales",0,35) }}...
                                            @break
                                        @case('621')
                                            {{ substr("621 - Incorporación Fiscal",0,35) }}...
                                            @break
                                        @case('625')
                                            {{ substr(" 625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas",0,35) }}...
                                            @break
                                        @case('626')
                                            {{ substr("626 - Régimen Simplificado de Confianza",0,35) }}...
                                            @break
                                        @case('I06281')
                                                {{ substr("628 - Hidrocarburos",0,35) }}...
                                            @break
                                        @case('629')
                                            {{ substr(" 629 - De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales",0,35) }}...
                                            @break
                                        @case('630')
                                            {{ substr("630 - Enajenación de acciones en bolsa de valores",0,35) }}...
                                            @break 
                                        @default
                                            No Encontrado
                                            @break;
                                    @endswitch
                                </td> 
                                <td>
                                    {{ $row->email }}
                                </td>
                                <td>
                                     {{ $row->phone }}
                                </td>
                                <td style="text-align: right">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </button>
                                        
                                        <ul class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(0px, 38px);" data-popper-placement="bottom-start">
                                            
                                            <!-- LoginUser -->
                                            <li>
                                                <a href="{{ Asset('/generate_bill_client/'.$row->id) }}" class="dropdown-item">
                                                    Generar Factura
                                                </a>
                                            </li>
                                            
                                            @if($row->tax_id != 'XAXX010101000')
                                            <li>
                                                <a href="{{ Asset($link.$row->id.'/edit') }}" class="dropdown-item">
                                                    Editar
                                                </a>
                                            </li>
                                            <!-- Delete -->
                                            <li>
                                                <a href="javascript::void()" class="dropdown-item" onclick="deleteConfirm('{{ Asset($link.'delete/'.$row->id) }}')">
                                                    Eliminar
                                                </a>
                                            </li>
                                            @endif
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