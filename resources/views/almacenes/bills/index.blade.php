@extends('layouts.app')

@section('title') Gestión de facturación @endsection
@section('breadcrumb') Facturas @endsection


@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
                            
            <div class="card py-3 m-b-30"> 
                <div class="card-body py-3 m-b-30" style="padding-top: 25px">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Identificador</th>
                                <th>Nombre / Razón Social</th>
                                <th>RFC</th> 
                                <th>Fecha</th>
                                <th>Monto</th>  
                                <th>Status</th>
                                <th>Descarga</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($data->data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->customer->legal_name }}</td>
                                <td>{{ $row->customer->tax_id }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <span style="font-weight: 600;color: rgb(0, 71, 207);">
                                        ${{ number_format($row->total,2) }}
                                    </span>
                                </td> 
                                <td>
                                    @switch($row->status)
                                        @case("valid")
                                            <span style="border: 1px solid #e8f7f3;background-color: #e8f7f3;color: #003d2f;padding: 4px 8px;border-radius: 12px;">
                                                <i class="mdi mdi-check"></i>
                                                Válida</span>
                                            @break
                                        @case("pending")
                                            <span class="badge bg-warning">Pendiente</span>
                                            @break
                                        @case("canceled")
                                            <span class="badge bg-danger">Cancelada</span>
                                            @break
                                        @case("draft")
                                            <span class="badge bg-info">Borrador</span>
                                            @break
                                        @default 
                                    @endswitch
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-download-box"></i>
                                            Descargar
                                        </button>
                                        
                                        <ul class="dropdown-menu" style="" data-popper-placement="top-start">
                                            
                                            <!-- LoginUser -->
                                            <li>
                                                <a href="{{ Asset('/download_bill/'.$row->id.'/xml') }}" class="dropdown-item">
                                                    <span class="mdi mdi-code-tags"></span>
                                                    XML
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Asset('/download_bill/'.$row->id.'/pdf') }}" class="dropdown-item">
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                    PDF
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Asset('/download_bill/'.$row->id.'/zip') }}" class="dropdown-item">
                                                    <span class="mdi mdi-folder-zip-outline"></span>
                                                   ZIP
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td style="text-align: right">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </button>
                                        
                                        <ul class="dropdown-menu" style="" data-popper-placement="top-start">
                                            
                                            <!-- LoginUser -->
                                            <li>
                                                <a href="{{ Asset('/send_bill_email/'.$row->id) }}" class="dropdown-item">
                                                    Enviar por correo
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Asset('/cancel_bill/'.$row->id) }}" class="dropdown-item">
                                                    Cancelar Factura
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