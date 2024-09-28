@extends('layouts.app')

@section('title') Generar Factura @endsection
@section('breadcrumb') Nuevo elemento @endsection

@section('content') 


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mx-auto"> 
            {!! Form::model($data, ['url' => [$form_url],'files' => true],['class' => 'col s12']) !!}
                @if($data)
                    <input type="hidden" name="clientId" value="{{ $data->id }}">
                @endif

                <div class="card py-3 m-b-30">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Name">Nombre:</label>
                                <input type="text" name="Name" id="Name" class="form-control" readonly style="background: #dce0e5;" value="@if($data) {{ $data->legal_name }} @endif">
                            </div> 
                            <div class="col-md-3">
                                <label for="rfc">RFC:</label>
                                <input type="text" name="rfc" id="rfc" class="form-control" readonly style="background: #dce0e5;" value="@if($data) {{ $data->tax_id }} @endif">
                            </div> 
                            <div class="col-md-3">
                                <label for="phone">Telefono:</label>
                                <input type="text" name="phone" id="phone" class="form-control" readonly style="background: #dce0e5;" value="@if($data) {{ $data->phone }} @endif">
                            </div> 
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="payment_form">Forma de pago:</label> 
                                <select name="payment_form" id="payment_form" class="form-select" >
                                    <option value="01">Efectivo</option>
                                    <option value="02">Cheque nominativo</option>
                                    <option value="03">Transferencia electrónica de fondos</option>
                                    <option value="04">Tarjeta de crédito</option>
                                    <option value="05">Monedero electrónico</option>
                                    <option value="06">Dinero electrónico</option>
                                    <option value="08">Vales de despensa</option>
                                    <option value="12">Dación en pago</option>
                                    <option value="13">Pago por subrogación</option>
                                    <option value="14">Pago por consignación</option>
                                    <option value="15">Condonación</option>
                                    <option value="17">Compensación</option>
                                    <option value="23">Novación</option>
                                    <option value="24">Confusión</option>
                                    <option value="25">Remisión de deuda</option>
                                    <option value="26">Prescripción o caducidad</option>
                                    <option value="27">A satisfacción del acreedor</option>
                                    <option value="28">Tarjeta de débito</option>
                                    <option value="29">Tarjeta de servicios</option>
                                    <option value="30">Aplicación de anticipos</option>
                                    <option value="31">Intermediario pagos</option>
                                    <option value="99">Por definir</option>
                                </select>
                            </div> 
                            <div class="col-md-6">
                                <label for="payment_method">Método de pago:</label>
                                
                                <select name="payment_method" id="payment_method" class="form-select" >
                                    <option value="PUE">Pago en Una sola Exhibición</option>
                                    <option value="PPD">Pago en Parcialidades o Diferido</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="use">Uso de CFDI</label>
                                <select name="use" id="use" class="form-select">
                                    <option value="G01">Adquisición de mercancías</option>
                                    <option value="G02">Devoluciones, descuentos o bonificaciones</option>
                                    <option value="G03">Gastos en general</option>
                                    <option value="I01">Construcciones</option>
                                    <option value="I02">Mobiliario y equipo de oficina por inversiones</option>
                                    <option value="I03">Equipo de transporte</option>
                                    <option value="I04">Equipo de cómputo y accesorios</option>
                                    <option value="I05">Dados, troqueles, moldes, matrices y herramental</option>
                                    <option value="I06">Comunicaciones telefónicas</option>
                                    <option value="I07">Comunicaciones satelitales</option>
                                    <option value="I08">Otra maquinaria y equipo</option>
                                    <option value="D01">Honorarios médicos, dentales y gastos hospitalarios</option>
                                    <option value="D02">Gastos médicos por incapacidad o discapacidad</option>
                                    <option value="D03">Gastos funerales</option>
                                    <option value="D04">Donativos</option>
                                    <option value="D05">Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)</option>
                                    <option value="D06">Aportaciones voluntarias al SAR</option>
                                    <option value="D07">Primas por seguros de gastos médicos</option>
                                    <option value="D08">Gastos de transportación escolar obligatoria</option>
                                    <option value="D09">Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones</option>
                                    <option value="D10">Pagos por servicios educativos (colegiaturas)</option>
                                    <option value="P01">Por definir</option>
                                </select>                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <hr />
                            <h3>Agregar Productos</h3>
                        </div>
                        
                        <div id="listItems">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="Description">Producto</label>
                                    <select name="item[]" id="item" class="form-select">
                                        @foreach ($products->data as $item)
                                            <option value="{{ $item->id }}">{{ $item->description }} <small>({{$item->unit_name}})</small> </option>
                                        @endforeach
                                    </select>
                                </div>
                    
                                <div class="col-md-5">
                                    <label for="qty">Cantidad</label>
                                    <input type="number" step="1" name="qty[]" id="qty" class="form-control" required="">
                                </div>

                                <div class="col-md-1" style="margin-top: 1.43em !important;">
                                    <button class="btn btn-success btnAddItem"><i class="mdi mdi-plus-circle"></i></button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
                
                <button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button><br><br>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
           
            // Add new item to list
            let items = 0;
            $(".btnAddItem").click(function() {
                
                items++;
                $("#listItems").append('<div class="row mb-3" id="item_column_'+items+'">'+
                    '<div class="col-md-6">'+
                        '<label for="Description">Producto</label>'+
                        '<select name="item[]" id="item" class="form-select">'+
                            '@foreach ($products->data as $item)'+
                                '<option value="{{ $item->id }}">{{ $item->description }} <small>({{$item->unit_name}})</small> </option>'+
                            '@endforeach'+
                        '</select>'+
                    '</div>'+ 
                    '<div class="col-md-5">'+
                        '<label for="qty">Cantidad</label>'+
                        '<input type="number" step="1" name="qty[]" id="qty" class="form-control" required="">'+
                    '</div>'+ 
                    '<div class="col-md-1" style="margin-top: 1.43em !important;">'+
                        '<button class="btn btn-danger" onclick="DeleteItem('+items+')"><i class="mdi mdi-trash-can-outline"></i></button>'+
                    '</div>'+
                '</div>');
            });
        });

        
        function DeleteItem(id)
        {
            $("#item_column_"+id).remove();

        }
    </script>
@endsection