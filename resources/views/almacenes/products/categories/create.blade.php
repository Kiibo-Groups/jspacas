@extends('layouts.app')
@section('title')
    Productos
@endsection
@section('page_active')
    Categorias
@endsection
@section('subpage_active')
    Nuevo
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
                        <div class="col-md-6" style="text-align: right;"><a href="{{ Asset($link) }}"
                                class="btn btn-success rounded-pill waves-effect waves-light"
                                style=" margin-right:20px">Listado
                                categorias</a>&nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>

                <form action="{{ $form_url }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('almacenes.products.categories.form')
                </form>

            </div>

        </div>
    </div>
@endsection
