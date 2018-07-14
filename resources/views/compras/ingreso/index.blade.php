@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><!--la clase de este div es las medidas responsivas de bootstrap-->
		<h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{URL::action('PdfController@pdf_ingreso')}}"><button class="btn btn-warning">Reporte</button></a></h3><!--el boton manda a la vista create para agregar una nueva categoria-->
		@include('compras.ingreso.search')<!--eto invoca a la vista search.blade.php-->
	</div>	
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($ingresos as $ing)<!--recorre la variable categoria recibida desde el controlador con los datos de la bd-->
				<tr>
					<td>{{ $ing->fecha_hora }}</td>
					<td>{{ $ing->nombre }}</td>
					<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->num_comprobante  }}</td>
					<td>{{ $ing->impuesto }}</td>
					<td>{{ $ing->total }}</td>
					<td>{{ $ing->estado }}</td>
					<td>
						<a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a><!--el metodo url es de laravel y envia al controlador CategoriaController a su metodo edit la id-->
						<a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a><!--data target hace referencia al modal y la id de la categoria a eliminar-->
					</td>
				</tr>
				@include('compras.ingreso.modal')<!--esto invoca al archivo modal.blade.php para poder generar los modal para eliminar-->
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}<!--el metodo render() permite paginar la informacion-->
	</div>
</div>	
@endsection