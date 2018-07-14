@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><!--la clase de este div es las medidas responsivas de bootstrap-->
		<h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{URL::action('PdfController@pdf_articulo')}}"><button class="btn btn-warning">Reporte</button></a></h3><!--el boton manda a la vista create para agregar una nueva categoria-->
		@include('almacen/articulo/search')<!--eto invoca a la vista search.blade.php-->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Código</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($articulos as $art)<!--recorre la variable categoria recibida desde el controlador con los datos de la bd-->
				<tr>
					<td>{{ $art->idarticulo }}</td><!--para hace un echo en laravel se hace con las llaves-->
					<td>{{ $art->nombre }}</td>
					<td>{{ $art->codigo }}</td>
					<td>{{ $art->categoria }}</td>
					<td>{{ $art->stock }}</td>
					<td><img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{ $art->nombre }}" height="100px" width="100px" class="img-thumbnail"></td><!--esto llama a la carpeta public/imagen que es donde se guardan las imagenes-->
					<td>{{ $art->estado }}</td>
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a><!--el metodo url es de laravel y envia al controlador CategoriaController a su metodo edit la id-->
						<a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a><!--data target hace referencia al modal y la id de la categoria a eliminar-->
					</td>
				</tr>
				@include('almacen.articulo.modal')<!--esto invoca al archivo modal.blade.php para poder generar los modal para eliminar-->
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}<!--el metodo render() permite paginar la informacion-->
	</div>
</div>	
@endsection