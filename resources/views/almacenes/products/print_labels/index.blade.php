@extends('layouts.app')
@section('title')
    Productos
@endsection
@section('page_active')
    Impresion de etiquetas
@endsection
@section('subpage_active')
    Etiquetas
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
                    </div>
                </div>

                <form action="{{ $form_url }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name">Bodega *</label>
                                                <select name="bodega" id="bodega" class="form-select">
                                                    @foreach ($almacens as $item)
                                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="col-md-12 mt-4">
                                            <button type="submit" class="btn btn-success btn-cta">
                                                <i class="mdi mdi-file-excel"></i>
                                                Descargar Excel
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </form>

            </div>

        </div>
    </div>
@endsection
