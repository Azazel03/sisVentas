@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Artículo</h3>
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
			{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}<!--files=>true permite almacenar archivos-->
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del Artículo..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="categoria">Categorias</label>
				<select name="idcategoria" class="form-control">
					@foreach ($categorias as $cat)<!--esto es porque en el ArticuloFormRequest, en el metodo create estamos retornando todas las categorias, entonces solo mostramos lo que nos retorna el metodo-->
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option><!--mostramos el nombre de la categoria pero enviamos al metodo request la id de la categoria-->
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código del Artículo..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del Artículo..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del Artículo..."><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control">
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