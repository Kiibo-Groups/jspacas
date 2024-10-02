<input type="hidden" name="role" value="1">
<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nombre del Almacen</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                id="name" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="userName">Nombre de usuario</label>
                            <input type="text" class="form-control" id="userName" name="username"
                                value="{{ $data->username }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="phone">Número teléfonico</label>
                            <input type="text" class="form-control" id="whatsapp_1" name="whatsapp_1"
                                value="{{ $data->whatsapp_1 }}" autocomplete="off">
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Información de acceso</h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" autocomplete="off">
                        <span class="d-block mt-1" style="font-size:11px;color:red;" style="font-size:11px;color:red;">
                            Correo para el inicio de sesión
                        </span>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="new_password">Contraseña <small>(Ingresa una si deseas cambiarla)</small> </label>
                            <input type="password" class="form-control" id="password" name="password" value="" autocomplete="password">
                            <span class="d-block mt-1" style="font-size:11px;color:red;" style="font-size:11px;color:red;">
                                Contraseña para el inicio de sesión
                            </span>
                        </div>
                    </div>
                </div>
                
             
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 pt-3">
                        <label for="logo">
                        @if ($data->id)
                            <img src="{{ Asset('upload/user/logo/' . $data->logo) }}" height="150" style="cursor: pointer">
                        @else
                            <img src="{{ Asset('assets/images/placeholder.png') }}" height="150" style="cursor: pointer;border: 1px solid #e1e1e1;">
                        @endif

                        </label>
                        <input type="file" name="logo" style="display: none" id="logo" class="form-control" @if(!$data->id) required="required" @endif>
                    </div>
                    
                    <div class="col-md-6 pt-3"> 
                        <div class="form-check form-switch">
                            <input name="status" type="checkbox" class="form-check-input" id="customSwitch1" 
                            @if ($data->id)
                                @if($data->status == 1) checked @endif 
                            @else 
                            checked
                            @endif >
                            <label class="form-check-label" for="customSwitch1">Estatus</label>
                        </div>
                        
                    </div>
                </div>
            </div>    
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- col-4-->
 
</div>
