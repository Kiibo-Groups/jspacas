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
                            <label for="brand_id">Marca</label>
                            <select name="brand_id" id="brand_id" class="form-select" required="required">
                                
                                @foreach($brands as $brn)
                                <option value="{{ $brn->id }}" @if($data->brand_id == $brn->id) selected @endif>{{ $brn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="bodega_id">Bodega</label>
                            <select name="bodega_id" id="bodega_id" class="form-select" required="required"> 
                                @foreach($almacens as $alm)
                                <option value="{{ $alm->id }}" @if($data->bodega_id == $alm->id) selected @endif>{{ $alm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="type_unit">Unidad</label>
                            <input type="text" class="form-control" name="type_unit" placeholder="Unidad (Por ejemplo, KG, PC, etc.)" value="{{ $data->type_unit }}"
                                id="type_unit" autocomplete="off" required="required">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="name">Peso</label>
                            <input type="text" class="form-control" name="weight" value="{{ $data->weight }}"
                                id="weight" autocomplete="off" required="required">
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
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="minimum_amount">Cantidad minima de compra</label>
                            <input type="text" class="form-control" name="minimum_amount"
                                value="{{ $data->minimum_amount }}" id="minimum_amount" autocomplete="off" required="required">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="barcode">Codigo de barras</label> 
                            <div class="input-group">
                                <span class="input-group-text" style="cursor: pointer" onclick="generateNumber()">
                                    <i class="mdi mdi-barcode-scan"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="barcode" aria-label="barcode" name="barcode" value="{{ $data->barcode }}" id="barcode" autocomplete="off" required="required">
                            </div>
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

        <div class="card p-2">

          
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="discount_rate">Tipo Descuento</label>
                        <select name="discount_rate" id="discount_rate" class="form-select">
                            <option value="0" @if($data->discount_rate == 0) selected @endif>En %</option>
                            <option value="1" @if($data->discount_rate == 1) selected @endif>Fijo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Descuento</label>
                        <input type="text" class="form-control" name="discount" value="{{ $data->discount }}"
                            id="discount" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="taxes">Tax/IVA</label>
                        <select name="taxes" id="taxes" class="form-select valid" title="Impuesto del valor agregado" aria-invalid="false">
                            <option value="0.160000" @if($data->taxes == '0.160000') selected @endif>IVA 16%</option>
                            <option value="0.08" @if($data->taxes == '0.08') selected @endif>IVA 8%</option>
                            <option value="0.000000" @if($data->taxes == '0.000000') selected @endif>IVA 0%</option>
                            <option value="0" data-type="exento" @if($data->taxes == '0') selected @endif>Exento</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Precio Unitario</label>
                        <input type="text" class="form-control" name="price" value="{{ $data->price }}"
                            id="taxes" autocomplete="off" required="required">
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div> 