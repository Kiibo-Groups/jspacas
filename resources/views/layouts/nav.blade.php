<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
      
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    {{ auth()->guard()->user()->name }}
                     <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bienvenido(a) !</h6>
                </div>

                <!-- item-->
                <a href="{{ url('dashboard') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Mi Cuenta</span>
                </a> 
                
                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="javascript:void(0)" class="dropdown-item notify-item logout_btn" action="{{ route('logout') }}">
                    <i class="fe-log-out"></i>
                    <span>Cerrar sessión</span>
                </a> 
            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ url('./') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="logo" height="44">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" height="25">
            </span>
        </a>
        <a href="{{ url('./') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm-white.png') }}" alt="logo" height="44">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="logo" height="25">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main"> @yield('page_active') </h4>
        </li>
        
    </ul>

    <div class="clearfix"></div> 
</div>