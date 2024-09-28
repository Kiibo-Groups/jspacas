<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Empresa Mexicana especializada en el autotransporte de carga terrestre. " name="description" />
    <meta content="KiiboGroups" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/config/default/app.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled="disabled" />
    <link href="{{ asset('assets/css/config/default/app-dark.min.css?v=' . now()) }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled="disabled" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- CSS Extras -->
    @yield('css')
</head>

<body class="loading"
    data-layout='{
        "mode": "light", "width": "fluid", "menuPosition": "fixed",
        "sidebar": { "color": "dark", "size": "fluid", "showuser": true}, 
        "topbar": { "color": "light" }, 
        "showRightSidebarOnPageLoad": true}'
    data-topbar-color="light" @if (Route::is('login'))  @endif>
    <!-- Begin page -->
    <div id="wrapper">
        <main style="padding-top: 0 !important;height: 100vh;">
            <section class="vh-100">
                <div class="container-fluid">
                    <div class="row mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="text-center">
                                    <a href="index.html" class="logo">
                                        <img src="{{ asset('resources/images/logo-dark.png') }}" alt="" height="22" class="logo-light mx-auto">
                                    </a>
                                </div>
                                <div class="card">
                  
                                    <div class="card-body p-4">
                  
                                        <div class="text-center">
                                            <h1 class="text-error">404</h1>
                                            <h3 class="mt-3 mb-2">Página no encontrada</h3>
                                            <p class="text-muted mb-3">Parece que has tomado un camino equivocado. No te preocupes... sucede
                                              lo mejor de nosotros. Es posible que desees comprobar tu conexión a Internet. He aquí un pequeño consejo que podría
                                              ayudarle a volver a la normalidad.</p>
                  
                                            <a href="{{ route('home') }}" class="btn btn-danger waves-effect waves-light"><i class="fas fa-home mr-1"></i> Back to Home</a>
                                        </div>
                  
                  
                                    </div> <!-- end card-body -->
                                </div>
                                <!-- end card -->
                  
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </section>
        </main>
    </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>