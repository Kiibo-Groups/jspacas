@extends('layouts.app')
@section('title')
    Salidas
@endsection
@section('page_active')
    Listado de salidas
@endsection
@section('subpage_active')
    Salidas
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table  class="table table-hover table-responsive" id="products_code">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th> 
                                            <th>Proveedor</th>
                                            <th>Bodega</th>
                                            <th>Categoria</th>
                                            <th>Precio</th>
                                            <th>Código</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td width="10%">
                                                <img src="{{ asset('upload/products/'.$row->image) }}" style='height: 40px;width: 40px;border-radius: 2003px;'>
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->supplier }}</td> 
                                            <td>{{ $row->bodega }}</td> 
                                            <td>{{ $row->category }}</td>
                                            <td>
                                                <span class="badge bg-success">${{ number_format($row->price,2) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $row->code }}</span>
                                            </td>
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product">Producto *</label> 
                                    <div class="input-group"> 
                                        <input type="text" class="form-control" id="inputScanCode" placeholder="Ingresa el Código de barras" aria-label="product" aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="cursor: pointer" onclick="ScanCodeInput()">
                                            <i class="mdi mdi-barcode-scan"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center card-body card-body-product" style="display: none;"> 
                                <div>
                                    <h4>último producto agregado</h4>
                                    <img src="" id="image_prod" class="rounded-circle avatar-xl img-thumbnail mb-3" alt="profile-image">
                                    <p class="text-muted font-13 mb-4" id="description_prod"></p>
                                    <div class="text-start">
                                        <p class="text-muted font-13"><strong>Producto :</strong> <span class="ms-2" id="name_prod"></span></p>

                                        <p class="text-muted font-13"><strong>Proveedor :</strong><span class="ms-2" id="supplier_prod"></span></p>

                                        <p class="text-muted font-13"><strong>Precio :</strong> <span class="ms-2 badge bg-success" id="price_prod"></span></p>

                                        <p class="text-muted font-13 m-b-5"><strong>Codigo :</strong> <span class="ms-2 badge bg-info" id="code_prod"></span></p>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
 <!-- third party js -->
 <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="../assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
 <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="../assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
 <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="../assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
 <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="../assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
 <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
 <script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
 <script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
 <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
 <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
 <!-- third party js ends -->

 <!-- Datatables init --> 
 
<script>

    var table = $("#products_code").DataTable({
        order: [[1, 'desc']],
        buttons: ["copy", "pdf"],
       
    }); 
    $("#selection-datatable").DataTable({
        select: {
            style: "multi"
        }
    }),
    table.buttons().container().appendTo("#products_code_wrapper .col-md-6:eq(0)"),
    $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
    $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
    $(".dataTables_length label").addClass("form-label");

    let inputScanCode = document.getElementById('inputScanCode'); 
    $("#inputScanCode").focus();

    inputScanCode.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            ScanCodeInput();
        }
    })

    function ScanCodeInput() {
        // Send request to the server to get the product data
        let productCode = inputScanCode.value;

        if (productCode != "") {
            
            let route = "{{ url('getProductBarCodeSalidas') }}/"+productCode;
            
            fetch(route).then(data => data.json()).then((data) => {
                if (data.status == 200) { 
                    if (data.data == 'codeRegister') {
                        Swal.fire({
                            title: 'Código validado!!',
                            text: "El código ingresado ya ha sido validado anteriormente..",
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = url;
                            }
                        });   
                    }else if(data.data == 'notEnoughStock') {
                        Swal.fire({
                            title: 'Sin Stock!!',
                            text: "El producto que intentas marcar se ha quedado sin Stock..",
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = url;
                            }
                        });   
                    }else {
                        let product = data.htmlProduct;

                        let dataProd = data.dataProd;

                        console.log(dataProd)

                        $("#image_prod").attr('src', dataProd.image);
                        $("#description_prod").text(dataProd.descript);
                        $("#name_prod").text(dataProd.name);
                        $("#supplier_prod").text(dataProd.supplier);
                        $("#price_prod").text("$"+dataProd.price);
                        $("#code_prod").text(dataProd.code);


                        $(".card-body-product").show('slideDown');
 
                        $("#products_code").find('tbody').prepend(product).hide().show('slideDown');
                        
                        // $('#products_code').DataTable().ajax.reload();
                        // table.rows.add({
                        //     'id' : dataProd.id,
                        //     'image' : dataProd.image,
                        //     'name' : dataProd.name,
                        //     'supplier' : dataProd.supplier,
                        //     'bodega' : dataProd.bodega,
                        //     'category' : dataProd.category,
                        //     'price' :"$"+dataProd.price,
                        //     'code' : dataProd.code
                        // }).draw(); 
                        
                    }
                }
            });
        }else {
            Swal.fire({
                title: 'Campo Vacio!!',
                text: "Por favor ingresa un valor valido..",
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.reload();
                }
            });
        }
    }
</script>
@endsection