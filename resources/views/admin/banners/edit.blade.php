@extends('layouts.admin')
@section('title') Gestor de Anuncios @endsection
@section('page_active') Anuncios @endsection 
@section('subpage_active') Editar Elemento @endsection 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            {!! Form::model($data, ['url' => [$form_url],'files' => true,'method' => 'PATCH'],['class' => 'pt-3']) !!}
                @include('admin.banners.form')
            </form>
        </div>
    </div>
</div>
@endsection