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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product">Producto *</label> 
                                            <div class="input-group">
                                                <select name="product" id="inputScanCode" class="form-select"  required="required"> 
                                                    @foreach($products as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn input-group-text btn-success waves-effect waves-light" onclick="ScanCodeInput()">
                                                    Buscar Producto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

                                    <table class="table table-hover" id="products_code">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th> 
                                                <th>Proveedor</th>
                                                <th>Categoria</th>
                                                <th>Precio</th> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

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

@section('js')
    <script>

        let inputScanCode = document.getElementById('inputScanCode');
        let tbodyRef = document.getElementById("products_code").getElementsByTagName('tbody')[0];
        let product_id = document.getElementById('product_id');
        inputScanCode.focus();

        function ScanCodeInput() {
            // Send request to the server to get the product data
            let productCode = inputScanCode.value;
            let route = "{{ url('getProductId') }}/"+productCode;
            
            $("#products_code").find('tbody').empty();
            
            fetch(route).then(data => data.json()).then((data) => {
                if (data.status == 200) {
                    console.log(data.htmlProduct);
                    let product = data.htmlProduct;  
                    product_id.value = data.product_id;
                    $("#products_code").find('tbody').append(product);
                }
            });
        }

    </script>
@endsection