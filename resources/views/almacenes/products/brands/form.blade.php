<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="name">Nombre de la marca</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                id="name" autocomplete="off">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="meta">Meta</label>
                            <input type="text" class="form-control" name="meta" value="{{ $data->meta }}"
                                id="meta" autocomplete="off">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="meta">Meta descripción</label>
                            <textarea class="form-control" name="description" id="description" cols="10" rows="5">{{ $data->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card p-2">
            <div class="row">
                <div class="col-md-12 p-2">
                    @if ($data->id)
                        <img src="{{ Asset('upload/brands/' . $data->logo) }}" style="width: 100%;">
                    @else
                        <img src="{{ Asset('assets/images/placeholder.png') }}" style="width: 100%;">
                    @endif
                    <label for="inputEmail6">Logo</label>
                    <input type="file" name="logo" class="form-control"
                        @if (!$data->id) required="required" @endif>
                </div>
            </div>
        </div>

        <div class="card p-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input name="status" type="checkbox" class="form-check-input" id="customSwitch1"
                        @if ($data->id) @if ($data->status == 1) checked @endif @else
                            checked @endif >
                        <label class="form-check-label" for="customSwitch1">Estatus</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-2">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div><!-- col-4-->


</div>
