<div class="modal fade modal-slide-in-rigth" aria-hidden="true" role="dialog" tabindex="1" id="modal-delete-{{$cat->idcategoria}}">
	{{Form::Open(array('action'=>array('CategoriaController@destroy',$cat->idcategoria),'method'=>'delete'))}}<!--creamos un array para que aparezca el eliminar para cada elemento de la lista, invocamos el metodo a través de destroy en la clase CategoriaController, le pasamos la idcategoria, el metodo delete llama la funcion eliminar de la clase-->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span><!--aparecerá una x en la parte superior del modal para poder cerrarlo-->
				</button>
				<h4 class="modal-title">Eliminar Categoria</h4>
			</div>
			<div class="modal-body">
				<p>Confirmé si es que quiere eliminar la categoria</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>