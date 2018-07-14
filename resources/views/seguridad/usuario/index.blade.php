@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><!--la clase de este div es las medidas responsivas de bootstrap-->
		<h3>Listado de Usuarios <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a>  <a href="{{URL::action('PdfController@pdf_user')}}"><button class="btn btn-warning">Reporte</button></a></h3><!--el boton manda a la vista create para agregar una nueva categoria-->
		@include('seguridad.usuario.search')<!--eto invoca a la vista search.blade.php-->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
				@foreach ($usuarios as $usu)<!--recorre la variable categoria recibida desde el controlador con los datos de la bd-->
				<tr>
					<td>{{ $usu->id }}</td><!--para hace un echo en laravel se hace con las llaves-->
					<td>{{ $usu->name }}</td>
					<td>{{ $usu->email }}</td>
					<td>
						<a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a><!--el metodo url es de laravel y envia al controlador CategoriaController a su metodo edit la id-->
						<a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a><!--data target hace referencia al modal y la id de la categoria a eliminar-->
					</td>
				</tr>
				@include('seguridad.usuario.modal')<!--esto invoca al archivo modal.blade.php para poder generar los modal para eliminar-->
				@endforeach
			</table>
		</div>
		{{$usuarios->render()}}<!--el metodo render() permite paginar la informacion-->
	</div>
</div>	
@endsection