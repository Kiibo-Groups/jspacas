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
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled="disabled" />

    <link href="{{ asset('assets/css/config/default/app.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled="disabled" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- CSS Extras -->
    @yield('css')
</head>

<body class="loading"
    data-layout='{
            "mode": "light", 
            "width": "fluid", 
            "menuPosition": "fixed", 
            "sidebar": { 
                "color": "dark", 
                "size": "default", 
                "showuser": true
            }, 
            "topbar": {
                "color": "light"
            }, 
            "showRightSidebarOnPageLoad": true
        }'>

    <!-- Begin page -->
    <div id="wrapper">
        @if (!Route::is('login'))
            <!-- ========== Left Topbar Start ========== -->
            @include('layouts.nav')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.sidebar')
            <!-- Left Sidebar End -->
        @endif

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="@if (!Route::is('login')) content-page @else account-pages my-5 @endif"
            @if (Route::is('rutas')) style="padding: 0 !important;min-height: 100vh;margin-top: 0;" @endif>
            <div class="@if (!Route::is('login')) content @else container @endif">

                <main class="py-4"
                    @if (Route::is('rutas')) style="padding-top: 0 !important;height: 100vh;" @endif>

                    @if (Session::has('error'))
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>ERROR : </strong> {{ Session::get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    @endif


                    @if (Session::has('message'))
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>SUCCESS : </strong> {{ Session::get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div> <!-- end col -->
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>

            @yield('modal')

            @if (!Route::is('login') && !Route::is('rutas'))
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &copy; JSPacas By <a href="https://kiibo.mx"
                                    target="_blank">KiiboGroups</a>
                            </div>

                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            @endif
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- knob plugin -->
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    @if (!Route::is('login'))
        <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
        @if (Route::is('dashboard'))
            <!--Morris Chart-->
            <script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
            <!-- Dashboar init js-->
            {{-- <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script> --}}
        @endif
    @endif

    <!-- Toastr js -->
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <!-- JS Extras -->
    @yield('js')

    <script>
        function deleteConfirm(url) {
            Swal.fire({
                title: '¿Estas seguro(a)?',
                text: "Estas a punto de eliminar este elemento.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, Eliminar!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Eliminado!',
                        'Este elemento ha sido eliminado con éxito.',
                        'success'
                    )

                    window.location = url;
                }
            });
        }

        function confirmAlert(url) {
            Swal.fire({
                title: '¿Estas seguro(a)?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Hacerlo!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Cambio!',
                        'Este elemento ha sido actualizado con éxito.',
                        'success'
                    )

                    window.location = url;
                }
            })
        }

        function showMsg(data) {
            Swal.fire(data);
        }
    </script>

</body>

</html>
