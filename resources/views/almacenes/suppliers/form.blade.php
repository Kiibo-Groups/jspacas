<input type="hidden" name="almacen_id" value="{{ Auth::user()->id }}">
<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                id="name" autocomplete="off">
                        </div>
                    </div> 
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="phone">Número teléfonico</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $data->phone }}" autocomplete="off">
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="address">Dirección</label>
                            <input type="address" class="form-control" id="address" name="address" value="{{$data->address}}" autocomplete="off">
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
                            <img src="{{ Asset('upload/suppliers/logo/' . $data->logo) }}" height="150" style="cursor: pointer">
                        @else
                            <img src="{{ Asset('assets/images/placeholder.png') }}" height="150" style="cursor: pointer;border: 1px solid #e1e1e1;">
                        @endif

                        </label>
                        <input type="file" name="logo" style="display: none" id="logo" class="form-control" @if(!$data->id) required="required" @endif>
                    </div>

                    <div class="col-md-12 pt-3"> 
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
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button>
                    </div>
                </div>
            </div>    
        </div> 
    </div><!-- col-4-->
</div>
