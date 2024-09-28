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
                    <div class="row">
                        <div class="col-sm-7 px-0 d-none d-sm-block" style="background-image: url('{{ asset('assets/images/background.jpg') }}'); background-size: cover;  background-position: center;">

                            <div class="w-100 vh-100 d-flex flex-column justify-content-end position-relative">
                             
                                <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" style="width: 20%;position: absolute;top: 0;right: 0;margin: 25px;">

                                <div class="text-center">
                                    <button type="button" class="btn btn-link btn-floating text-white" style="font-size: 30px;">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating text-white" style="font-size: 30px;">
                                        <i class="fab fa-instagram"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating text-white" style="font-size: 30px;">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-5 text-black" style="background-color: #ffffff;">
                            @yield('content')
                            <div class="px-5 ms-xl-5">
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
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- knob plugin -->
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    @if (!Route::is('login'))
        <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
        @if (Route::is('dash'))
            <!--Morris Chart-->
            <script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
            <!-- Dashboar init js-->
            <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
        @endif
    @endif


    <!-- JS Extras -->
    @yield('js')


    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

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
