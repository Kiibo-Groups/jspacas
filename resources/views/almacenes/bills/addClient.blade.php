@extends('layouts.app')

@section('title') Agregar Cliente @endsection
@section('breadcrumb') Nuevo elemento @endsection

@section('content') 


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mx-auto"> 
            {!! Form::model($data, ['url' => [$form_url],'files' => true],['class' => 'col s12']) !!}
                @include('almacenes.bills.formClient')
            </form>
        </div>
    </div>
</div>
@endsection