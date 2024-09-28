@if($data)
<input type="hidden" name="clientId" value="{{ $data->id }}">
@endif
<div class="card py-3 m-b-30">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="Name">Nombre / Razón Social:</label>
                <input type="text" name="Name" id="Name" class="form-control" style="text-transform: uppercase" required="" value="@if($data) {{ $data->legal_name }} @endif">
            </div>
            <div class="col-md-6">
                <label for="Email">E-Mail:</label>
                <input type="text" name="Email" id="Email" class="form-control" required="" value="@if($data) {{ $data->email }} @endif">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone">Telefono:</label>
                <input type="tel" name="phone" id="phone" class="form-control" required="" value="@if($data) {{ $data->phone }} @endif">
            </div>
            <div class="col-md-3">
                <label for="Rfc">RFC:</label>
                <input type="text" name="Rfc" id="Rfc" class="form-control" required="" style="text-transform: uppercase" value="@if($data) {{ $data->tax_id }} @endif">
            </div>

            <div class="col-md-3">
                <label for="ZipCode">C.P:</label>
                <input type="text" name="ZipCode" id="ZipCode" class="form-control" required="" value="@if($data) {{ $data->address->zip }} @endif">
            </div>
        </div> 

        <div class="row mb-3">
            
            <div class="col-md-6">
                <label for="cmbFiscalRegimes">Régimen fiscal:</label>
                <select class="form-select" id="cmbFiscalRegimes" name="FiscalRegime" required="">
                    <option value="">Selecciona el Régimen fiscal</option>
                    <option value="601" @if($data) @if($data->tax_system == '601') selected @endif @endif >601 - General de Ley Personas Morales</option>
                    <option value="603" @if($data) @if($data->tax_system == '603') selected @endif @endif >603 - Personas Morales con Fines no Lucrativos</option>
                    <option value="605" @if($data) @if($data->tax_system == '605') selected @endif @endif >605 - Sueldos y Salarios e Ingresos Asimilados a Salarios</option>
                    <option value="606" @if($data) @if($data->tax_system == '606') selected @endif @endif >606 - Arrendamiento</option>
                    <option value="607" @if($data) @if($data->tax_system == '607') selected @endif @endif >607 - Régimen de Enajenación o Adquisición de Bienes</option>
                    <option value="608" @if($data) @if($data->tax_system == '608') selected @endif @endif >608 - Demás ingresos</option>
                    <option value="610" @if($data) @if($data->tax_system == '610') selected @endif @endif >610 - Residentes en el Extranjero sin Establecimiento Permanente en México</option>
                    <option value="611" @if($data) @if($data->tax_system == '611') selected @endif @endif >611 - Ingresos por Dividendos (socios y accionistas)</option>
                    <option value="612" @if($data) @if($data->tax_system == '612') selected @endif @endif >612 - Personas Físicas con Actividades Empresariales y Profesionales</option>
                    <option value="614" @if($data) @if($data->tax_system == '614') selected @endif @endif >614 - Ingresos por intereses</option>
                    <option value="615" @if($data) @if($data->tax_system == '615') selected @endif @endif >615 - Régimen de los ingresos por obtención de premios</option>
                    <option value="616" @if($data) @if($data->tax_system == '616') selected @endif @endif >616 - Sin obligaciones fiscales</option>
                    <option value="621" @if($data) @if($data->tax_system == '621') selected @endif @endif >621 - Incorporación Fiscal</option>
                    <option value="625" @if($data) @if($data->tax_system == '625') selected @endif @endif >625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
                    <option value="626" @if($data) @if($data->tax_system == '626') selected @endif @endif >626 - Régimen Simplificado de Confianza</option>
                    <option value="628" @if($data) @if($data->tax_system == '628') selected @endif @endif >628 - Hidrocarburos</option>
                    <option value="629" @if($data) @if($data->tax_system == '629') selected @endif @endif >629 - De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales</option>
                    <option value="630" @if($data) @if($data->tax_system == '630') selected @endif @endif >630 - Enajenación de acciones en bolsa de valores</option>
                </select> 
                
            </div> 
        </div>
  
    </div>
</div>
 
<h1 style="font-size: 20px">Información personal <small>Datos Opcionales</small> </h1>
<div class="card py-3 m-b-30">
    <div class="card-body">
        <div class="row mb-3">  
            <div class="col-md-12">
                <label for="Street">Calle:</label>
                <input type="text" name="Street" id="Street" class="form-control" required="" value="@if($data) {{ $data->address->street }} @endif">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="ExteriorNumber">No. Exterior:</label>
                <input type="text" name="ExteriorNumber" id="ExteriorNumber" required="" class="form-control" value="@if($data) {{ $data->address->exterior }} @endif">
            </div>

            <div class="col-md-6">
                <label for="InteriorNumber">No. Interior:</label>
                <input type="text" name="InteriorNumber" id="InteriorNumber" required="" class="form-control" value="@if($data) {{ $data->address->interior }} @endif">
            </div>
        </div>

        <div class="row mb-3">  
            <div class="col-md-12">
                <label for="Neighborhood">Colonia:</label>
                <input type="text" name="Neighborhood" id="Neighborhood" required="" class="form-control" value="@if($data) {{ $data->address->neighborhood }} @endif">
            </div>
        </div>

        <div class="row mb-3">  
            <div class="col-md-12">
                <label for="Locality">Localidad:</label>
                <input type="text" name="Locality" id="Locality" required="" class="form-control" value="@if($data) {{ $data->address->city }} @endif">
            </div>
        </div>

        <div class="row mb-3">  
            <div class="col-md-12">
                <label for="Municipality">Municipio:</label>
                <input type="text" name="Municipality" id="Municipality" required="" class="form-control" value="@if($data) {{ $data->address->municipality }} @endif">
            </div>
        </div>

        <div class="row mb-3">  
            <div class="col-md-12">
                <label for="State">Estado:</label>
                <input type="text" name="State" id="State" class="form-control" required="" value="@if($data) {{ $data->address->state }} @endif">
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button><br><br>
 