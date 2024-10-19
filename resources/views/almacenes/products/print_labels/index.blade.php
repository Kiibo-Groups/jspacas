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

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ $form_url }}" method="post" enctype="multipart/form-data"
                                    autocomplete="off">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="product_id" id="product_id" required>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label for="qty_labels">Cantidad de elementos *</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" aria-label="qty_labels" name="qty_labels" min="1" value="1" aria-describedby="basic-addon1">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="mdi mdi-format-list-numbered-rtl"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <button type="submit" class="btn btn-success btn-cta">
                                                <i class="mdi mdi-file-excel"></i>
                                                Descargar Excel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 