
<div class="card-body">
    <div class="row">

        <div class="col-md-8"> 
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pt-3">
                            <label for="inputEmail6">Imagen</label>
                            <input type="file" name="img" class="form-control" @if(!$data->id) required="required" @endif>
                        </div>
                        
                        <div class="col-md-6 pt-3">
                            <label for="inputEmail6">Posición del banner</label>
                            <select name="position" class="form-select" required="required">
                                <option value="0" @if($data->position == 0) selected @endif>Principal (270px * 140px)</option>
                            </select>
                        </div> 

                        <div class="col-md-6 pt-3">
                            <label for="user_id">Asignar Negocio</label>
                            <select name="user_id" id="user_id" class="form-select" required="required">
                                <option value="">Selecciona un negocio</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" @if($data->store_id == $store->id) selected @endif>{{ $store->name }}</option>
                                @endforeach
                            </select>
                        </div> 

                        
                    </div>
                </div>    
            </div>

            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Información del anuncio</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pt-3">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}">
                        </div>
                        <div class="col-md-6 pt-3">
                            <label for="subtitle">SubTitulo</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{$data->subtitle}}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 pt-3">
                            <label for="descript">Descripción</label>
                            <textarea name="descript" id="descript" cols="15" rows="10" class="form-control">{!! $data->descript !!}</textarea> 
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
                            @if ($data->id)
                                <img src="{{ Asset('upload/banner/'.$data->img) }}" style="width: 100%;">
                            @else
                                <img src="{{ Asset('assets/images/placeholder.png') }}" style="width: 100%;">
                            @endif
                        </div>
                        
                        <div class="col-md-6 pt-3"> 
                            <div class="form-check form-switch">
                                <input name="status" type="checkbox" class="form-check-input" id="customSwitch1" 
                                @if ($data->id)
                                    @if($data->status == 1) checked @endif 
                                @else 
                                checked
                                @endif >
                                <label class="form-check-label" for="customSwitch1">Estatus del anuncio</label>
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
        </div>
    </div>
</div>
 




