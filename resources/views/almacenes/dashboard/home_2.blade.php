@extends("layouts.admin")

@section('title') Dashboard | JSPacas. @endsection

@section('page_active') Dashboard @endsection 

@section('css')
<!-- plugin css -->
<link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
       
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                   

                    <h4 class="header-title mt-0 mb-3">Ultimos Productos Registrados</h4>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Almacen</th>
                                <th>Bodega</th>
                                <th>Status</th> 
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Almacen 1</td> 
                                    <td>Bodega primera</td>
                                    <td><span class="badge bg-success">Registrado</span></td> 
                                </tr>  
                                <tr>
                                    <td>2</td>
                                    <td>Almacen 2</td> 
                                    <td>Bodega segunda</td>
                                    <td><span class="badge bg-success">Registrado</span></td> 
                                </tr>  
                                <tr>
                                    <td>3</td>
                                    <td>Almacen 3</td> 
                                    <td>Bodega tercera</td>
                                    <td><span class="badge bg-success">Registrado</span></td> 
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            
        </div><!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                     
                    <h4 class="header-title mt-0 mb-3">Ultimos usuarios</h4>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Adrian Quezada</td>
                                    <td>01/01/2017</td>
                                    <td><span class="badge bg-info">user</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Miguel angel</td>
                                    <td>01/01/2017</td>
                                    <td><span class="badge bg-info">user</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Alicarlo diaz</td>
                                    <td>01/01/2017</td>
                                    <td><span class="badge bg-info">user</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Enel viallamontez</td>
                                    <td>01/01/2017</td>
                                    <td><span class="badge bg-info">user</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                   
                    <h4 class="header-title mt-0 mb-3">Trending top - Almacenes</h4>

                    <div id="morris-line-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div> 
            </div>
        </div>

    </div>
    <!-- end row -->     

</div>
@endsection

@section('js') 
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-in-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-au-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-il-chicago-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-ca-lcc-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-europe-mill-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-fr-merc-en.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-merc.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-mill.js') }}"></script>
    <!-- Morris JS -->
    <script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
    <!-- Init js-->
    <script src="{{ asset('assets/js/pages/vector-maps.init.js') }}"></script>
    
    <script>
        !function(e) {
            "use strict";
            function a() {}

            a.prototype.createLineChart = function(e, a, r, t, i, o, s, b, n) {
                Morris.Line({
                    element: e,
                    data: a,
                    xkey: r,
                    ykeys: t,
                    labels: i,
                    fillOpacity: o,
                    pointFillColors: s,
                    pointStrokeColors: b,
                    behaveLikeLine: !0,
                    gridLineColor: "rgba(173, 181, 189, 0.1)",
                    hideHover: "auto",
                    lineWidth: "3px",
                    pointSize: 0,
                    preUnits: "",
                    dataLabels: !1,
                    resize: !0,
                    lineColors: n
                })
            },
            a.prototype.init = function() {
            e("#morris-line-example").empty(), 
            this.createLineChart("morris-line-example", [{
                    y: "2008",
                    a: 50,
                    b: 0
                },
                {
                    y: "2009",
                    a: 75,
                    b: 50
                },
                {
                    y: "2010",
                    a: 30,
                    b: 80
                },
                {
                    y: "2011",
                    a: 50,
                    b: 50
                },
                {
                    y: "2012",
                    a: 75,
                    b: 10
                },
                {
                    y: "2013",
                    a: 50,
                    b: 40
                },
                {
                    y: "2014",
                    a: 75,
                    b: 50
                },
                {
                    y: "2015",
                    a: 100,
                    b: 70
            }], "y", ["a", "b"], ["Ticketa activos", "Tickets cancelados"], ["0.1"], ["#ffffff"], ["#999999"], ["#ff8acc", "#5b69bc"]);
           
            },
            e.MorrisCharts = new a,
            e.MorrisCharts.Constructor = a
        } (window.jQuery),
        function(a) {
            "use strict";
            a.MorrisCharts.init();
            // window.addEventListener("adminto.setBoxed", function(e) {
            //     a.MorrisCharts.init()
            // }),
            // window.addEventListener("adminto.setFluid", function(e) {
            //     a.MorrisCharts.init()
            // })
        } (window.jQuery);
    </script>
@endsection