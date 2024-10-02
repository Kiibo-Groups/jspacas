@extends('layouts.app')
@section('title')
    Perfíl de administración
@endsection
@section('page_active')
    Almacenes
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
                        <div class="col-md-6" style="text-align: right;"><a href="{{ Asset($link . '/almacenes') }}"
                                class="btn btn-success rounded-pill waves-effect waves-light"
                                style=" margin-right:20px">Listado
                                Almacenes</a>&nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>

                {!! Form::model($data, ['url' => [$form_url],'files' => true,'method' => 'PATCH'],['class' => 'pt-3']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('almacenes.almacenes.form')
                </form>

            </div>

        </div>
    </div>
@endsection