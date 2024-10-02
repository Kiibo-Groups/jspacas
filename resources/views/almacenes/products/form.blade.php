<input type="hidden" name="almacen_id" value="{{ Auth::user()->id }}">

<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" placeholder="Nombre del producto" value="{{ $data->name }}"
                                id="name" autocomplete="off" required="required">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-select"  required="required"> 
                                @foreach($categorys as $cat)
                                <option value="{{ $cat->id }}" @if($data->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="supplier_id">Proveedor</label>
                            <select name="supplier_id" id="supplier_id" class="form-select"  required="required"> 
                                @foreach($suppliers as $cat)
                                <option value="{{ $cat->id }}" @if($data->supplier_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Precio Unitario</label>
                            <input type="text" class="form-control" name="price" value="{{ $data->price }}"
                                id="taxes" autocomplete="off" required="required" placeholder="$$">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="type_unit">Unidad</label>
                            <input type="text" class="form-control" name="type_unit" placeholder="Unidad (Por ejemplo, KG, PC, etc.)" value="{{ $data->type_unit }}"
                                id="type_unit" autocomplete="off" required="required">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="labels">Etiquetas</label>
                            <input type="text" class="selectize-close-btn" name="labels" required="required" placeholder="Escriba y persione enter para agregar una etiqueta" value="{{ $data->labels }}"
                                id="labels">
                        </div>
                    </div>

                  
                </div>
                 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="meta">Meta Descripción</label>
                            <input type="text" class="form-control" name="meta" value="{{ $data->meta }}" id="meta" autocomplete="off" required="required">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3"> 
                            <label for="description">Descripción</label>
                            <input type="hidden" id="description" name="description" value="{!! $data->description !!}">
                            <div style="height: 300px;" id="snow-editor">{!! $data->description !!}</div>
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
                    @if ($data->id)
                    <div class="col-md-4">
                        <label for="status">Estatus del producto</label>
                        <div class="form-check form-switch">
                            <input name="status" type="checkbox" class="form-check-input" @if ($data->status == 1) checked @endif  >
                        </div>
                    </div>
                    @endif
                     

                    <div class="col-md-12 mt-4">
                        <button type="submit" id="save" class="btn btn-success btn-cta">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-2">
            <div class="row">
                <div class="col-md-12 p-2">
                    @if ($data->id)
                        <img src="{{ Asset('upload/products/' . $data->image) }}" style="height:170px;">
                    @else
                        <img src="{{ Asset('assets/images/placeholder.png') }}" style="width: 100%;">
                    @endif
                    <br />
                    <br />
                    <label for="inputEmail6">Imagen producto</label>
                    <input type="file" name="image" class="form-control"
                        @if (!$data->id) required="required" @endif>
                </div>
            </div>
        </div>
 
    </div>
</div> 