<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nombre de la bodega</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                id="name" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Telefono</label>
                            <input type="text" class="form-control" name="phone" value="{{ $data->phone }}"
                                id="phone" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $data->email }}"
                                id="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Codigo postal</label>
                            <input type="text" class="form-control" name="zip_code" value="{{ $data->zip_code }}"
                                id="zip_code" autocomplete="off">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" name="state" value="{{ $data->state }}"
                                id="state" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Municipio</label>
                            <input type="text" class="form-control" name="city" value="{{ $data->city }}"
                                id="city" autocomplete="off">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Calle</label>
                            <input type="text" class="form-control" name="street" value="{{ $data->street }}"
                                id="street" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="name">Número exterior</label>
                            <input type="text" class="form-control" name="no_exterior"
                                value="{{ $data->no_exterior }}" id="no_exterior" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="no_interior">Número interior</label>
                            <input type="text" class="form-control" name="no_interior" value="{{ $data->no_interior }}"
                                id="no_interior" autocomplete="off">
                        </div>
                    </div>

                </div>
 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="details">Información adicional</label>
                            <textarea name="details" class="form-control" id="details" cols="10" rows="5">{!! $data->details !!}</textarea>
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
                    <div class="form-group mb-3">
                        <label for="almacenista_id">Asignar Almacenista</label>
                        <select name="almacenista_id" id="almacenista_id" class="form-select" required="required"> 
                            <option value="0">Selecciona un almacenista</option>
                            @foreach($almacenistas as $alm)
                            <option value="{{ $alm->id }}" @if($data->almacenista_id == $alm->id) selected @endif>{{ $alm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check form-switch">
                            <input name="status" type="checkbox" class="form-check-input" id="customSwitch1"
                            @if ($data->id) @if ($data->status == 1) checked @endif @else
                                checked @endif >
                            <label class="form-check-label" for="customSwitch1">Estatus</label>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
