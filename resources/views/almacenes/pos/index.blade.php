@extends('layouts.app')

@section('title')
    POS | JSPacas.
@endsection

@section('page_active')
    POS
@endsection

@section('css')
    <style>
        .text-12 {
            font-size: 12px;
        }

        .text-gray-600 {
            color: #1b1b28;
        }

        .text-gray-900 {
            color: #01010a;
        }

        .bold {
            font-weight: 600;
        }

        .card-custom {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .badge-position {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 50px;
        }

        .product-img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .btn-custom {
            width: 100%;
            margin-bottom: 10px;
        }

        .fixed-size-card {
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .fixed-size-card .wrap_img {
            background-position: center center;
            background-repeat: no-repeat;
            background-size: contain;
            width: 100%;
            height: 150px;
        }

        .badge-position {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .text-left {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .portfolioContainer .col-xl-3,
        .portfolioContainer .col-lg-4,
        .portfolioContainer .col-md-6 {
            display: flex;
            flex-direction: column;
        }

        .portfolioContainer a#addItem:hover {
            text-decoration: none;
            text-decoration-color: none;
        }

        .thumbs {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .portfolioContainer .name_price > div > span {
            font-size: 25px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="search" id="search"
                            placeholder="Buscar por nombre de producto">

                    </div>
                    <div class="col-md-4">
                        <select class="form-control" data-toggle="select2" data-width="100%" name="category_id">
                            <option value="">Todas las categorias</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" data-toggle="select2" data-width="100%" name="brand_id">
                            <option value="">Todas las marcas</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="port mb-2">
                    @if (count($data) > 0)
                        <div class="row portfolioContainer">
                            @foreach ($data as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                    <a href="javascript:void(0)" id="addItem" class="text-gray-600" onclick="handleAddItem('{{ $item->id }}')">
                                        <div class="gal-detail thumbs">
                                            <div class="card text-center card-custom fixed-size-card">
                                                {{-- Discount --}}
                                                @if ($item->discount > 0)
                                                    <div class="badge bg-danger badge-position">%{{ $item->discount }} Off</div>
                                                    <div class="badge bg-danger badge-position">%{{ $item->discount }} Off</div>
                                                @endif
                                                {{-- Discount --}}

                                                <div class="wrap_img" style="background-image: url('{{ asset('upload/products/' . $item->image) }}');"></div>
                                            </div>

                                            <div class="text-center name_price">
                                                <p class="font-16">{{ substr($item->name,0,20) }}</p>
                                                <div class="row text-center">
                                                    <span>${{ number_format($item->price, 2) }} </span> 
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row portfolioContainer">
                            <div class="col-md-12">

                                <div class="text-center">
                                    <p class="font-16 mt-4">Sin productos que mostrar</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-2">

                    <div class="search-box chat-search-box">
                        <input type="text" class="form-control" id="qrCode" name="qrcode" placeholder="Lector de Código QR"  onkeyup="ReadQRCode(this.value)">
                        <i class="mdi mdi-barcode-scan search-icon" onclick="ReadQR()"></i>
                    </div>

                    <hr style="margin:0;">

                    <div class="wrap_check_user" style="display: none;">
                        <ul class="list-unstyled chat-list mb-0">
                            <li class="active">
                                <a href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 chat-user-img active align-self-center me-2">
                                            <img src="" id="userQR" class="rounded-circle avatar-sm" >
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-truncate font-14 mt-0 mb-1 text-uppercase" id="userName"></h5> 
                                            <p class="text-truncate mb-0" id="userMail"></p>
                                        </div>
                                        <div class="font-11 text-success">Activo</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="boxy mt-4" style="border:1px;">
                        <div class="row">
                            <div class="col">

                                <table id="items" width="100%">
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="" width="100%">
                                    <tr>
                                        <td class="p-0 text-12">Sub total</td>
                                        <td id="sub-total" class="text-end text-12">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-12">Impuesto</td>
                                        <td id="tax" class="text-end text-12">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-12">% de Envio</td>
                                        <td id="shipping" class="text-end text-12">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-12">Descuento</td>
                                        <td id="discount" class="text-end text-12">$0.00</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <table class="" width="100%">
                                    <tr>
                                        <td class="p-0">
                                            <h4>TOTAL</h4>
                                        </td>
                                        <td id="total" class="text-end">
                                            <h4>$0</h4>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div><!--card-->

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary waves-effect">Envió</button>

                        <button type="button" class="btn btn-outline-secondary waves-effect">Descuento</button>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light"
                            onclick="submitOrder()">Realizar
                            pedido</button>

                    </div>
                </div>

            </div>
        </div>
@endsection

@section('modal')
    
<div id="order-confirm" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xl">
        <div class="modal-content" id="variants">
            <div class="modal-header bord-btm">
                <h4 class="modal-title h6">Order Summary</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" id="order-confirmation">
                <div class="p-4 text-center">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-base-3" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="oflinePayment()" class="btn btn-base-1 btn-warning">Pago con Terminal</button>
                <button type="button" onclick="submitOrder('cash')" class="btn btn-base-1 btn-success">Pago con Efectivo</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        let item = [];
        const bd = @json($data);
        const tax = document.querySelector('#tax');
        const items = document.querySelector('#items');
        const total = document.querySelector('#total');
        const subtotal = document.querySelector('#sub-total');
        const shipping = document.querySelector('#shipping');
        const discount = document.querySelector('#discount');
        const options2 = { style: 'currency', currency: 'MXN' };
        const numberFormat2 = new Intl.NumberFormat('es-MX', options2);

        let subTotal = 0;
        let Taxes    = 0;
        let totalAll = 0;
            

        function handleAddItem(idProd) { 
            let route = "{{ url('getProductId') }}/"+idProd;
            fetch(route).then(data => data.json()).then((data) => {
                if (data.status == 200) {
                    const info = data.data;
                    item.push(info);
                    renderItem();
                }
            });
        }

        function renderItem() {
            // Remove duplicates based on 'id'
            const uniqueItems = Object.values(item.reduce((acc, currentItem) => {
                acc[currentItem.id] = currentItem;
                return acc;
            }, {}));

            // Clear existing rows
            items.innerHTML = '';
            

            uniqueItems.forEach((value) => {
                const miItem = bd.filter((itemBD) => itemBD.id === value.id);

                const numUniItem = item.reduce((total, itemId) => {
                    return itemId.id === value.id ? total + 1 : total;
                }, 0);

                
                const price = numberFormat2.format(numUniItem * value.price);
                const newRow = document.createElement('tr');

                newRow.innerHTML = '<td width="10%" class="text-center">'
                    +'<button class="btn btn-danger waves-effect waves-light" onclick="deleteItem('+value.id+')"><i class="mdi mdi-delete"></i></button>'
                +'</td>'
                +'<td class="product-name" width="55%" class="text-gray-900">'+value.name.substr(0,10)+'...</td>'
                +'<td width="25%">'
                    +'<p class="price-per-item mb-0 text-12">$'+value.price+'</p>'
                    +'<p class="total-price mb-0 text-gray-900 bold" data-taxes="'+value.taxes+'" data-price="'+(numUniItem * value.price)+'">'+price+'</p>'
                +'</td>'
                +'<td width="10%" style="display: flex;align-items: center;">'
                    +'<a href="#" class="btn btn-danger text-white" onclick="incrementItem('+value.id+')" ><i class="mdi mdi-plus"></i></a>'
                    +'<p class="quantity mb-0" style="font-size: 20px;padding: 15px;">'+numUniItem+'</p>'
                    +'<a href="#" class="btn btn-success text-white" onclick="decrementItem('+value.id+')"><i class="mdi mdi-minus"></i></a>'
                +'</td>';

                items.appendChild(newRow);
            });

            calculateTotals();
        }

        function incrementItem(idProd) {
            let route = "{{ url('getProductId') }}/"+idProd;
            fetch(route).then(data => data.json()).then((data) => {
                if (data.status == 200) {
                    item.push(data.data);
                    renderItem();
                }
            });
        }

        function decrementItem(idProd) {
            const index = item.findIndex(currentItem => currentItem.id === idProd);
            if (index !== -1) {
                item.splice(index, 1);
            }
            renderItem();
        }

        function deleteItem(idProd) {
            item = item.filter(currentItem => currentItem.id !== idProd);
            renderItem();
        }

        function calculateTotals() {
            
            document.querySelectorAll('.total-price').forEach(priceElement => { 
                console.log(priceElement.getAttribute('data-price'));
                Taxes = priceElement.getAttribute('data-taxes');
                subTotal += parseFloat(priceElement.getAttribute('data-price'));
            });

            
            const tax = Taxes;//subTotal * 0.10;
            /*const shipping = 0.00;*/
            const discount = 0.00;
            //const total = subTotal + tax + shipping - discount;
            totalAll = subTotal + tax + discount;
            document.querySelector('#sub-total').innerText = `${numberFormat2.format(subTotal.toFixed(2))}`;
            document.querySelector('#tax').innerText = `$${parseFloat(tax).toFixed(2)}`;
            //  document.querySelector('#shipping').innerText = `$${shipping.toFixed(2)}`;
            document.querySelector('#discount').innerText = `$${discount.toFixed(2)}`;
            document.querySelector('#total').innerText = `${numberFormat2.format(parseFloat(totalAll).toFixed(2))}`;
        }

        function ReadQR()
        { 
            let qrCode = document.querySelector('input[name="qrcode"]');
            qrCode.value = "66dbbf8d25afca70a79594e6"; 
            ReadQRCode(qrCode.value)
        }

        let userData = [];  
        function ReadQRCode(ev)
        { 
            if (ev != '') {
                let qrCode = ev;
                let route = "{{ url('getUserId') }}/"+qrCode;
                fetch(route).then(data => data.json()).then((data) => {
                    if (data.status == 200) { 
                        userData = data.data; 
                        document.querySelector('#userQR').setAttribute('src','data:image/png;base64,'+userData.code_qr);

                        document.querySelector('#userName').innerText = userData.name; 
                        document.querySelector('#userMail').innerText = userData.whatsapp_1 +" | "+ userData.email; 
                        document.querySelector('.wrap_check_user').style.display = "block";
                    }else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.msg,
                        });
                    }
                });
            }

        }

        function submitOrder() { 

            if (userData) {
                const orderData = {
                    user_id: userData.id,
                    subtotal:parseFloat(subTotal).toFixed(2),
                    tax: tax,
                    discount: 0.00,
                    total: parseFloat(totalAll).toFixed(2),
                    shipping: 0.00,
                    products: item
                };

                console.log(orderData);

                fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "Orden Generada con éxito",
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Imprimir AutoFactura",
                            denyButtonText: `Solo Guardar`
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.open(data.data.self_invoice_url);
                            }
                            
                            location.reload(); 
                        });
                    }else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ha ocurrido un problema, por favor intente más tarde.!"
                        });
                    } 
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Por favor selecciona un cliente...",
                });
            }
        }
    </script>
@endsection
