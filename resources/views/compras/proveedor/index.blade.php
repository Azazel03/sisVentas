@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><!--la clase de este div es las medidas responsivas de bootstrap-->
		<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{URL::action('PdfController@pdf_proveedor')}}"><button class="btn btn-warning">Reporte</button></a></h3><!--el boton manda a la vista create para agregar una nueva categoria-->
		@include('compras.proveedor.search')<!--eto invoca a la vista search.blade.php-->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo Doc.</th>
					<th>Número Doc.</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
				@foreach ($personas as $per)<!--recorre la variable categoria recibida desde el controlador con los datos de la bd-->
				<tr>
					<td>{{ $per->idpersona }}</td><!--para hace un echo en laravel se hace con las llaves-->
					<td>{{ $per->nombre }}</td>
					<td>{{ $per->tipo_documento }}</td>
					<td>{{ $per->num_documento }}</td>
					<td>{{ $per->telefono }}</td>
					<td>{{ $per->email }}</td>
					<td>
						<a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"><button class="btn btn-info">Editar</button></a><!--el metodo url es de laravel y envia al controlador CategoriaController a su metodo edit la id-->
						<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a><!--data target hace referencia al modal y la id de la categoria a eliminar-->
					</td>
				</tr>
				@include('compras.proveedor.modal')<!--esto invoca al archivo modal.blade.php para poder generar los modal para eliminar-->
				@endforeach
			</table>
		</div>
		{{$personas->render()}}<!--el metodo render() permite paginar la informacion-->
	</div>
</div>	
@endsection