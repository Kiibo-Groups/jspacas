@extends('layouts.app')
@section('title') Perfíl de administración @endsection
@section('page_active') Dashboard @endsection 
@section('subpage_active') Perfíl @endsection 


@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-settings">Configuraciones</button>
                        </li>
                        <!--<li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#logos-edit">Logotipos</button>
                        </li>-->
                    </ul>
                    
                    <div class="tab-content pt-2">
                        <!-- Settings -->
                        <div class="tab-pane fade show active profile-settings pt-3" id="profile-settings">
                            <form action="{{ $form_url }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Nombre del negocio</label>
                                            <input type="text" class="form-control" name="name" value="{{$data->name}}" id="name"  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="userName">Nombre de usuario</label>
                                            <input type="text" class="form-control" id="userName" name="username" value="{{$data->username}}" autocomplete="off">
                                        </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="whatsapp_1">Número teléfonico</label>
                                            <input type="text" class="form-control" id="whatsapp_1" name="whatsapp_1" value="{{$data->whatsapp_1}}" autocomplete="off">
                                        </div>
                                    </div> 
                                </div>
                                
                                <hr />
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="email">Correo Administrativo</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" autocomplete="off">
                                            <span class="d-block mt-1" style="font-size:11px;color:red;" style="font-size:11px;color:red;">
                                                Correo para el inicio de sesión
                                            </span>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="new_password">Contraseña <small>(Ingresa una si deseas cambiarla)</small> </label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" value="" autocomplete="new-password">
                                            <span class="d-block mt-1" style="font-size:11px;color:red;" style="font-size:11px;color:red;">
                                                Contraseña para el inicio de sesión
                                            </span>
                                        </div>
                                    </div> 
                                </div>


                                <div class="text-left pt-16 mb-3">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Settings -->

                        <!-- Logos -->
                        <div class="tab-pane fade logos-edit pt-3" id="logos-edit">
                            <form action="{{ $form_url }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               
                                <div class="row mb-3 ec-vendor-uploads">
                                    <!-- Logo General -->
                                    <div class="col-lg-12">
                                        <label for="profileImage">Logo General &nbsp;<small>(128px * 128px)</small></label>
                                        <div class="mb-6 ec-preview">
                                            <input type='file' name='logo' id="logo" class="ec-image-upload" accept=".png, .jpg, .jpeg" hidden onchange="loadFileLogo(event)" />
                                            <label for="logo">
                                                @if($data->logo) 
                                                <img src="{{ asset('assets/images/users/'.$data->logo) }}" alt="image" class="img-fluid rounded" id="image-preview-logo" width="128"/>
                                                @else  
                                                <img src="{{ asset('assets/images/users/user-1.png') }}" alt="image" class="img-fluid rounded" id="image-preview-logo" width="128"/>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Logo General -->

                                    <!-- Logo Header Top -->
                                    <div class="col-lg-4">
                                        <label for="profileImage">Barra lateral &nbsp;<small>(140px * 49px)</small></label>
                                        <div class="mb-6 mt-3 ec-preview">
                                            <input type='file' name='logo_top' id="logo-top" class="ec-image-upload" accept=".png, .jpg, .jpeg" hidden onchange="loadFileLogoTop(event)" />
                                            <label for="logo-top">
                                                @if($data->logo_top) 
                                                <img src="{{ asset('assets/images/users/'.$data->logo_top) }}" alt="image" class="img-fluid rounded" id="image-preview-logo-top" width="140"/>
                                                @else  
                                                <img src="{{ asset('assets/images/users/logo-top.png') }}" alt="image" class="img-fluid rounded" id="image-preview-logo-top" width="140"/>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Logo Header Top -->

                                    <!-- Logo Header Top min -->
                                    <div class="col-lg-4">
                                        <label for="profileImage">Barra lateral responsive &nbsp;<small>(128px * 128px)</small></label>
                                
                                        <div class="mb-6 mt-3 ec-preview">
                                            <input type='file' name='logo_top_sm' id="logo-top-sm" class="ec-image-upload" accept=".png, .jpg, .jpeg" hidden onchange="loadFileLogoTopSm(event)" />
                                            <label for="logo-top-sm">
                                                @if($data->logo_top_sm) 
                                                <img src="{{ asset('assets/images/users/'.$data->logo_top_sm) }}" alt="image" class="img-fluid rounded img-thumbnail" id="image-preview-logo-sm" width="64"/>
                                                @else  
                                                <img src="{{ asset('assets/images/users/logo-sm.png') }}" alt="image" class="img-fluid rounded img-thumbnail" id="image-preview-logo-sm" width="64"/>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Logo Header Top min -->
                                </div> 
                                <br />
 

                                <div class="text-left pt-16 mb-3">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Logos -->
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    

                    <h4 class="header-title mt-0 mb-3">Iconos / Logotipos</h4>

                    <ul class="list-group mb-0 user-list">

                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="user avatar-sm float-start me-2">
                                    <img src="{{ asset('assets/images/'.$data->logo_top_sm) }}" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="user-desc">
                                    <h5 class="name mt-0 mb-1">Icono de perfil</h5>
                                    <p class="desc text-danger mb-0 font-12">126px * 24px</p>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="user avatar-sm float-start me-2">
                                    <img src="{{ asset('assets/images/'.$data->logo_top) }}" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="user-desc">
                                    <h5 class="name mt-0 mb-1">Logotipo</h5>
                                    <p class="desc text-danger mb-0 font-12">202px * 186px</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>  -->
    </div>
</div>
@endsection

@section('js')
<script>
    var loadFileLogo = function(event) { 
        var output = document.getElementById('image-preview-logo');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };

    var loadFileLogoTop = function(event) { 
        var output = document.getElementById('image-preview-logo-top');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };

    var loadFileLogoTopSm = function(event) { 
        var output = document.getElementById('image-preview-logo-sm');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection