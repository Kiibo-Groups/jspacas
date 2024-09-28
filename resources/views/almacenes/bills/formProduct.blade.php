@if($data)
<input type="hidden" name="clientId" value="{{ $data->Id }}">
@endif
<div class="card py-3 m-b-30">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="Name">Nombre Interno:</label>
                <input type="text" name="Name" id="Name" class="form-control" required="" value="@if($data) {{ $data->Name }} @endif">
            </div>

            <div class="col-md-6">
                <label for="IdentificationNumber">No Identificación <small>(obligatorio solo para comercio exterior)</small> </label>
                <input type="text" name="IdentificationNumber" id="IdentificationNumber" class="form-control" value="@if($data) {{ $data->IdentificationNumber }} @endif">
            </div>
        </div>

        <div class="row mb-3">
             
            <div class="col-md-6">
                <label for="Description">Descripción</label>
                <textarea type="text" name="Description" id="Description" class="form-control" required="">@if($data) {{ $data->Description }} @endif</textarea>
            </div>

            <div class="col-md-6">
                <label for="Price">Precio Unitario</label>
                <input type="number" step="0.5" name="Price" id="Price" class="form-control" required="" value="@if($data) {{ $data->Address->Price }} @endif">
            </div>
        </div> 
 
    </div>
</div>

<h1 style="font-size: 20px">Cambios obligatorios CFDI 4.0 SAT <small>Asocia tu producto al CATALOGO del SAT</small> </h1>
<div class="card py-3 m-b-30">
    <div class="card-body">
        <div class="row mb-3">  
            <div class="col-md-6">
                <label for="CodeProdServ">
                    Busca tu CLAVE (8 caracteres):
                    <a class="text-primary" target="_blank" href="http://200.57.3.46:443/PyS/catPyS.aspx">Buscar Clave</a>
                </label>
                <input type="text" name="CodeProdServ" id="CodeProdServ" class="form-control" required="" value="@if($data) {{ $data->CodeProdServ }} @endif">
            </div>
            <div class="col-md-6">
                <label for="UnitCode">Define Codigo de unidad de tu producto
                    <a class="text-primary" target="_blank" href="http://200.57.3.46:443/PyS/catUnidades.aspx">Buscar Unidad</a>
                </label>
                <input type="text" name="UnitCode" id="UnitCode" class="form-control" required="" value="@if($data) {{ $data->UnitCode }} @endif">
            </div>
        </div> 

        <div class="row mb-3">  
            
            <div class="col-md-6">
                <label for="Unit">Define la UNIDAD de tu producto
                    <a class="text-primary" target="_blank" href="http://200.57.3.46:443/PyS/catUnidades.aspx">Buscar Unidad</a>
                </label>
                <input type="text" name="Unit" id="Unit" class="form-control" required="" value="@if($data) {{ $data->Unit }} @endif">
            </div>

            <div class="col-md-6">
                <label for="NameCodeProdServ">
                    Objeto Impuesto
                </label>
                <select class="form-select" name="ObjetoImp" data-type="dropdownlist" data-default="" required="" aria-required="true">
                    <option value="" selected="selected">Selecciona una opción</option>
                    <option value="01">01 - No objeto de impuesto</option>
                    <option value="02">02 - Sí objeto de impuesto</option>
                    <option value="03">03 - Sí objeto del impuesto y no obligado al desglose</option>
                    <option value="04">04 - Sí objeto del impuesto y no causa impuesto</option>
                </select>
            </div> 
        </div> 
 
    </div>
</div>

<h1 style="font-size: 20px">Impuestos Federales </h1>
<div class="card py-3 m-b-30">
    <div class="card-body">
        <div class="row mb-3">  
            <div class="col-md-6">
                <label for="Street">IVA</label>
                <select name="FederalTaxes[0].Rate" class="form-select valid" title="Impuesto del valor agregado" aria-invalid="false">
                    <option value="0.160000">IVA 16%</option>
                    <option value="0.08">IVA 8%</option>
                    <option value="0.000000">IVA 0%</option>
                    <option value="0" data-type="exento">Exento</option>
                    <option value="-">-</option>
                </select>
            </div>

            {{-- <div class="col-md-6">
                <label for="ExteriorNumber">IVA Ret</label>
                <select class="form-select" name="FederalTaxes[1].Rate">
                    <option value="0.16">IVA Ret 16%</option>
                    <option value="0.106668">IVA Ret 10.6668%</option>
                    <option value="0.106667">IVA Ret 10.6667%</option>
                    <option value="0.106666">IVA Ret 10.6666%</option>
                    <option value="0.1067">IVA Ret 10.67%</option>
                    <option value="0.1066">IVA Ret 10.66%</option>
                    <option value="0.106">IVA Ret 10.6%</option>
                    <option value="0.1">IVA Ret 10%</option>
                    <option value="0.0919">IVA Ret 9.19%</option>
                    <option value="0.08">IVA Ret 8%</option>
                    <option value="0.06">IVA Ret 6%</option>
                    <option value="0.054">IVA Ret 5.4%</option>
                    <option value="0.053333">IVA Ret 5.3333%</option>
                    <option value="0.05">IVA Ret 5%</option>
                    <option value="0.04">IVA Ret 4%</option>
                    <option value="0.03">IVA Ret 3%</option>
                    <option value="0.025">IVA Ret 2.5%</option>
                    <option value="0.02">IVA Ret 2%</option>
                    <option value="0.007">IVA Ret 0.7%</option>
                    <option value="0.005333">IVA Ret 0.5333%</option>
                    <option value="0.005">IVA Ret 0.5%</option>
                    <option value="0.002">IVA Ret 0.2%</option>
                    <option value="0">IVA Ret 0%</option>
                    <option value="-" selected="selected">-</option>
                </select>
            </div> --}}
        </div>
        
        {{-- <div class="row mb-3">
            <div class="col-md-6">
                <label>
                    IEPS
                </label>
                <select name="FederalTaxes[3].Rate" class="form-select" title=" Impuesto Especial Sobre Producción y Servicios">
                    <option value="3.000000">IEPS 300%</option>
                    <option value="1.600000">IEPS 160%</option>
                    <option value="0.530000">IEPS 53%</option>
                    <option value="0.500000">IEPS 50%</option>
                    <option value="0.350000">IEPS 35%</option>
                    <option value="0.304000">IEPS 30.4%</option>
                    <option value="0.300000">IEPS 30%</option>
                    <option value="0.298800">IEPS 29.88%</option>
                    <option value="0.265000">IEPS 26.5%</option>
                    <option value="0.250000">IEPS 25%</option>
                    <option value="0.090000">IEPS 9%</option>
                    <option value="0.080000">IEPS 8%</option>
                    <option value="0.070000">IEPS 7%</option>
                    <option value="0.060000">IEPS 6%</option>
                    <option value="0.059100">IEPS 5.91%</option>
                    <option value="0.040000">IEPS 4%</option>
                    <option value="0.030000">IEPS 3%</option> 
                    <option value="-" selected="selected">-</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="Neighborhood">ISR</label>
                <select name="FederalTaxes[2].Rate" class="form-select" title="Impuesto Sobre la Renta">
                    <option value="0.350000">ISR 35%</option>
                    <option value="0.250000">ISR 25%</option>
                    <option value="0.200000">ISR 20%</option>
                    <option value="0.106660">ISR 10.666%</option>
                    <option value="0.100000">ISR 10%</option>
                    <option value="0.054000">ISR 5.4%</option>
                    <option value="0.040000">ISR 4%</option>
                    <option value="0.030000">ISR 3%</option>
                    <option value="0.021000">ISR 2.10%</option>
                    <option value="0.020000">ISR 2%</option>
                    <option value="0.012500">ISR 1.25%</option>
                    <option value="0.011000">ISR 1.1%</option>
                    <option value="0.010000">ISR 1%</option>
                    <option value="0.009000">ISR 0.9%</option>
                    <option value="0.005000">ISR 0.5%</option>
                    <option value="0.004000">ISR 0.4%</option>
                    <option value="0.001000">ISR 0.1%</option>
                    <option value="0.000000">ISR 0%</option>
                    <option value="-" selected="selected">-</option>
                </select>
            </div>
        </div>  --}}
    </div>
</div>

<button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button><br><br>
 