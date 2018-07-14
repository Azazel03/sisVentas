@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>
			@if (count($errors)>0)<!--si los errores son mayores que cero se muestra el div de abajo-->
			<div class="alert alert-danger">
				<ul><!--este bucle va almacenar todos los errores que puedan haber al momento de crear y los va a mostrar-->
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach	
				</ul>
			</div>
			@endif
		</div>
	</div>		
			{!!Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del Cliente..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Dirección</label>
				<input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="categoria">Documento</label>
				<select name="tipo_documento" class="form-control">
					<option value="DNI">DNI</option><!--mostramos el nombre de la categoria pero enviamos al metodo request la id de la categoria-->
					<option value="RUC">RUC</option>
					<option value="PAS">PAS</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Número Documento</label>
				<input type="text" name="num_documento" value="{{old('num_documento')}}" class="form-control" placeholder="Número Documento..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Teléfono</label>
				<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Email</label>
				<input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
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
@endsection