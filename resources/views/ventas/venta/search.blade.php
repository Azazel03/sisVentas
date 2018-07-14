{!! Form::open(array('url'=>'ventas/venta','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}<!--esto abre un formulario y envia la infortmación a la url que se indica, no se autocompleta,.es de metodo get y es de tipo busqueda-->
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn"><!--esta clase hace que salga al costado el boton-->
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>	
{{Form::close()}}<!--cierra el formulario-->