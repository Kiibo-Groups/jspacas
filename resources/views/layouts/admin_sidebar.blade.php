
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        
        <!-- User box -->
        <div class="user-box text-center"> 
            {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md"> --}}
            <div class="dropdown">
                <a href="#" class="user-name h5 mt-2 mb-1 d-block">Bienvenido(a)</a>
            </div> 

            <p class="text-muted left-user-info">Administrador</p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ url('logout') }}">
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
                    <a href="{{ route('admin.dash') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>&nbsp;Dashboard </span>
                    </a>
                </li> 
          
                <li>
                    <a href="{{  route('admin.city') }}">
                        <i class="mdi mdi-map-marker"></i>
                        <span>&nbsp;Ciudades </span>
                    </a>
                </li>

                <li>
                    <a href="{{  route('admin.almacenes') }}">
                        <i class="mdi mdi-mailbox-up"></i>
                        <span>&nbsp;Almacenes </span>
                    </a>
                </li>
                 
            
                <li class="menu-title mt-2">Settings</li>
            
                <li>
                    <a href="{{ route('admin.setting') }}">
                        <i class="mdi mdi-cog"></i>
                        <span>&nbsp;Configuraciones </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.account') }}">
                        <i class="dripicons-user-id"></i>
                        <span>&nbsp;Mi Cuenta </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>