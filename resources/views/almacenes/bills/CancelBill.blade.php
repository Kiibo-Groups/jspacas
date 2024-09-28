@extends('layouts.app')

@section('title') Cancelar Factura @endsection
@section('breadcrumb') Factura #{{$id}} @endsection

@section('content') 


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mx-auto"> 
            {!! Form::model($id, ['url' => [$form_url],'files' => true],['class' => 'col s12']) !!}
                <input type="hidden" name="id" value="{{ $id }}">
               
                <div class="card py-3 m-b-30">
                    <div class="card-body">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="motive">Motivo de la cancelación:</label> 
                                <select name="motive" id="motive" class="form-select" >
                                    <option value="01">Comprobante emitido con errores con relación</option>
                                    <option value="02">Comprobante emitido con errores sin relación</option>
                                    <option value="03">No se llevó a cabo la operación</option>
                                    <option value="04">Operación nominativa relacionada en la factura global</option>
                                </select>
                            </div>  
                        </div> 
                    </div>
                </div> 
                
                <button type="submit" class="btn btn-success btn-cta">Cancelar Factura</button><br><br>
                
            </form>
        </div>
    </div>
</div>
@endsection