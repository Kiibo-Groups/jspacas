@extends('layouts.app')

@section('title')
    Menu | JSPacas.
@endsection

@section('page_active')
    Menu
@endsection

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="card p-2">
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-6">
                            <h4>ORDER #: 12345678</h4>
                        </div>
                        <div class="col-6">
                            <p class="mt-1"><i class="mdi mdi-keyboard-outline"></i> TABLE: <span>1</span>
                                <i class="mdi mdi-time"></i> TIME: <span>20:02 PM</span>
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ITEM</th>
                                <th>PRICE</th>
                                <th>QTY</th>
                                <th>SUBTOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chicken wings

                                    </td>
                                  
                                    <td>$20,00</td>
                                    <td>1</td>
                                    <td>$20,00</td>
                                </tr>
                               
                                <tr>
                                    <td>Chicken wings

                                    </td>
                                  
                                    <td>$20,00</td>
                                    <td>1</td>
                                    <td>$20,00</td>
                                </tr>

                                <tr>
                                    <td>Chicken wings

                                    </td>
                                  
                                    <td>$20,00</td>
                                    <td>1</td>
                                    <td>$20,00</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="button-list pe-xl-4 d-grid">
                      
                    <button type="button" class="btn btn-danger waves-effect waves-light my-4">CANCEL ORDER</button>
                    </div>
                </div>

                <div class="col-4">


                    <div class="row">
                        <div class="col">
                            <h4>TOTAL</h4>
                        </div>
                        <div class="col">
                            <h4>$38,50</h4>
                        </div>
                        
                    </div>


                    <div class="button-list pe-xl-4 d-grid">
                        
                        <button type="button" class="btn btn-info waves-effect waves-light my-4">PAY NOW</button>
                        </div>
                </div>
            </div>
        </div>

    </div>
@endsection