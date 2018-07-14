@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><!--la clase de este div es las medidas responsivas de bootstrap-->
		<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{URL::action('PdfController@pdf_venta')}}"><button class="btn btn-warning">Reporte</button></a></h3><!--el boton manda a la vista create para agregar una nueva categoria-->
		@include('ventas.venta.search')<!--eto invoca a la vista search.blade.php-->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($ventas as $ven)<!--recorre la variable categoria recibida desde el controlador con los datos de la bd-->
				<tr>
					<td>{{ $ven->fecha_hora }}</td>
					<td>{{ $ven->nombre }}</td>
					<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante  }}</td>
					<td>{{ $ven->impuesto }}</td>
					<td>{{ $ven->total_venta }}</td>
					<td>{{ $ven->estado }}</td>
					<td>
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a><!--el metodo url es de laravel y envia al controlador CategoriaController a su metodo edit la id-->
						<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a><!--data target hace referencia al modal y la id de la categoria a eliminar-->
					</td>
				</tr>
				@include('ventas.venta.modal')<!--esto invoca al archivo modal.blade.php para poder generar los modal para eliminar-->
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}<!--el metodo render() permite paginar la informacion-->
	</div>
</div>	
@endsection