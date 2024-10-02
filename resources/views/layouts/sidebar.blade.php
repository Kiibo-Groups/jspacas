
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        
        <!-- User box -->
        <div class="user-box text-center"> 
            <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name h5 mt-2 mb-1 d-block">Bienvenido(a)</a>
            </div> 

            <p class="text-muted left-user-info">
                {{ auth()->guard()->user()->name }}
            </p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="javascript:void(0)" class="logout_btn" action="{{ route('logout') }}">
                        <i class="mdi mdi-power"></i>
                    </a> 
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Principal</li>
                

                @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 2)
                <li>
                    <a href="{{ route('home') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>&nbsp;Dashboard </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 2)
                <li>
                    <a href="{{ route('entradas') }}">
                        <i class="mdi mdi-truck-check"></i>
                        <span>&nbsp;Entradas </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('salidas') }}">
                        <i class="mdi mdi-tag-minus"></i>
                        <span>&nbsp;Salidas </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-truck-trailer"></i>
                        <span>&nbsp;Pendientes </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 0)
                <li>
                    <a href="{{ route('almacenes.index') }}">
                        <i class="mdi mdi-mailbox-up"></i>
                        <span>&nbsp;SubCuentas </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                <li>
                    <a href="{{ route('almacenistas') }}">
                        <i class="mdi mdi-badge-account-horizontal"></i>
                        <span>&nbsp;Almacenistas </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                <li>
                    <a href="{{ route('suppliers') }}">
                        <i class="mdi mdi-cart-arrow-right"></i>
                        <span>&nbsp;Proveedores </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                <li>
                    <a href="#prods" data-bs-toggle="collapse">
                        <i class="mdi mdi-archive-outline"></i>
                        <span>&nbsp;Productos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="prods">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('products') }}">Listar Productos</a>
                            </li>
                            <li>
                                <a href="{{ url('products/create') }}">Agregar nuevo producto</a>
                            </li>
                            <li>
                                <a href="{{ url('products/print_labels') }}">Imprimir Etiquetas</a>
                            </li>
                            <li>
                                <a href="{{ url('products/almacens') }}">Bodegas</a>
                            </li>
                            <li>
                                <a href="{{ url('products/categories') }}">Categorias</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

             
                <li class="menu-title mt-2">Configuraciones</li>

                <li>
                    <a href="{{ url('/account') }}">
                        <i class="mdi mdi-cog"></i>
                        <span>&nbsp;Ajustes </span>
                    </a>
                </li> 

                <li>
                    <a href="javascript:void(0)" class="logout_btn" action="{{ route('logout') }}">
                        <i class="mdi mdi-power"></i>
                        <span>&nbsp;Cerrar sesión</span>
                    </a> 
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>