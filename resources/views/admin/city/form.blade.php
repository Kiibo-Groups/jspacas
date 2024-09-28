
<div class="row">
	

	<div class="col-lg-6 mx-auto  mt-2">
		<div class="card">
			<div class="card-body">
				<div class="tab-content" id="myTabContent1">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail6">Ingresa la ciudad</label>
								<input id="pac-input" class="controls form-control" name="name" value="{{ $data->name }}" type="text" placeholder="Ingresa la Ciudad">
							</div>

							<div class="form-group col-md-12 mt-3">
								<label for="inputEmail6">Status</label>
								<select name="status" class="form-select">
									<option value="0" @if($data->status == 0) selected @endif>Activo</option>
									<option value="1" @if($data->status == 1) selected @endif>Inactivo</option>
								</select>
							</div>

							<div class="form-group col-md-12 mt-3">
								<button type="submit" class="btn btn-success btn-cta">Guardar cambios</button>
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6 mx-auto  mt-2">
		<div class="card">
			<div class="card-body">
				<div class="tab-content" id="myTabContent1">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="form-row">
							@include('admin.city.google')
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 