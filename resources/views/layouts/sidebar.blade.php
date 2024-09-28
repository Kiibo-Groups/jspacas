
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        
        <!-- User box -->
        <div class="user-box text-center"> 
            <img @if (Auth::guard('admin')->check()) src="{{ asset('assets/images/logo.png') }}" @else src="{{ asset('upload/user/logo/'.Auth::user()->logo) }}" @endif alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name h5 mt-2 mb-1 d-block">Bienvenido(a)</a>
            </div> 

            <p class="text-muted left-user-info">
                @if (Auth::guard('admin')->check())
                {{ auth()->guard('admin')->user()->name }}
                @else 
                    {{ auth()->guard()->user()->name }}
                @endif
            </p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ route('user.logout') }}">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Principal</li>
                
                <li>
                    <a href="{{ route('home') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>&nbsp;Dashboard </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ route('pos') }}">
                        <i class="mdi mdi-printer-pos"></i>
                        <span>&nbsp;Sistema POS </span>
                    </a>
                </li> --}}

                <li>
                    <a href="{{ route('orders.index') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>&nbsp;Ordenes </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('almacenistas') }}">
                        <i class="mdi mdi-badge-account-horizontal"></i>
                        <span>&nbsp;Almacenistas </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('suppliers') }}">
                        <i class="mdi mdi-cart-arrow-right"></i>
                        <span>&nbsp;Proveedores </span>
                    </a>
                </li>

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
                            <li>
                                <a href="{{ url('products/brands') }}">Marcas</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li>
                    <a href="#purchases" data-bs-toggle="collapse">
                        <i class="mdi mdi-archive-outline"></i>
                        <span>&nbsp;Compras </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="purchases">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('products') }}">Todas las compras</a>
                            </li>
                            <li>
                                <a href="{{ url('products/create') }}">Crear Compra</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#purchases" data-bs-toggle="collapse">
                        <i class="mdi mdi-archive-outline"></i>
                        <span>&nbsp;Ventas </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="purchases">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('products') }}">Todas las ventas</a>
                            </li>
                            <li>
                                <a href="{{ url('products/create') }}">Crear Venta</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="menu-title mt-2">Configuraciones</li>

                <li>
                    <a href="{{ url('/ajustes') }}">
                        <i class="mdi mdi-cog"></i>
                        <span>&nbsp;Ajustes </span>
                    </a>
                </li> 
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>