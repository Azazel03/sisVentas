@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{$persona->nombre}}</h3>
			@if (count($errors)>0)<!--si los errores son mayores que cero se muestra el div de abajo-->
			<div class="alert alert-danger">
				<ul><!--este bucle va almacenar todos los errores que puedan haber al momento de crear y los va a mostrar-->
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach	
				</ul>
			</div>
			@endif
			{!!Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update',$persona->idpersona]])!!}<!--el metodo patch llama a la funcion editar en el controlador y en route le estamos pasando el datoa  la variable en la funcion update-->
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre del Cliente..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Dirección</label>
				<input type="text" name="direccion" required value="{{$persona->direccion}}" class="form-control" placeholder="Dirección..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="categoria">Documento</label>
				<select name="tipo_documento" class="form-control">
					@if ($persona->tipo_documento=='DNI')
						<option value="DNI" selected>DNI</option>
						<option value="RUC">RUC</option>
						<option value="PAS">PAS</option>
					@elseif ($persona->tipo_documento=='RUC')
						<option value="DNI">DNI</option>
						<option value="RUC" selected>RUC</option>
						<option value="PAS">PAS</option>	
					@else
						<option value="DNI">DNI</option>
						<option value="RUC">RUC</option>
						<option value="PAS" selected>PAS</option>
					@endif		
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Número Documento</label>
				<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Número Documento..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Teléfono</label>
				<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Email</label>
				<input type="text" name="email" value="{{$persona->email}}" class="form-control" placeholder="Email..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection