@extends('layouts.app')
@section('css')
<link href="{{ asset('assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('title')
    Productos
@endsection
@section('page_active')
    Productos
@endsection
@section('subpage_active')
    Actualizar
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
                                productos</a>&nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>
                {!! Form::model($data, ['url' => [$form_url],'files' => true,'method' => 'PATCH'],['class' => 'pt-3']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('almacenes.products.form')
                </form>

            </div>

        </div>
    </div>
@endsection
@section('js') 

<script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> 
<script src="{{ asset('assets/libs//bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>

<!-- Init js-->
<script>
    var quill = new Quill("#snow-editor", {
        theme: "snow",
        modules: {
            toolbar: [[{
                font: []
            },
            {
                size: []
            }], ["bold", "italic", "underline", "strike"], [{
                color: []
            },
            {
                background: []
            }], [{
                script: "super"
            },
            {
                script: "sub"
            }], [{
                header: [!1, 1, 2, 3, 4, 5, 6]
            },
                "blockquote", "code-block"], [{
                list: "ordered"
            },
            {
                list: "bullet"
            },
            {
                indent: "-1"
            },
            {
                indent: "+1"
            }], ["direction", {
                align: []
            }], ["link", "image", "video"], ["clean"]]
        }
    });

    document.getElementById('save').addEventListener('click', function() {
        var content = quill.root.innerHTML;
        
        document.getElementById('description').value = content;
    });
</script>
@endsection
