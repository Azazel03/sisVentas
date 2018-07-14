@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Artículo: {{$articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}<!--el metodo patch llama a la funcion editar en el controlador y en route le estamos pasando el datoa  la variable en la funcion update-->
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control"><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="categoria">Categorias</label>
				<select name="idcategoria" class="form-control">
					@foreach ($categorias as $cat)<!--esto es porque en el ArticuloFormRequest, en el metodo create estamos retornando todas las categorias, entonces solo mostramos lo que nos retorna el metodo-->
						@if ($cat->idcategoria==$articulo->idcategoria)
						<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option><!--mostramos el nombre de la categoria pero enviamos al metodo request la id de la categoria-->
						@else
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control"><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control"><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control"><!--el value hace que si se retorna porque no cumple los requerimientos, se muestra el valor ingresado incorrecto para poder corregirlo-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control">
				<!--esto ayuda a cargar una imagen si es que existe-->
				@if (($articulo->imagen)!="")
					<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
				@endif
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