<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
<table>
	<tr>
		<td><img src="img/logo_ventas.png"></td>
		<td><p>Sistemas Ventas - Gabriel Arcos<br>Copyright © 2018 All rights reserved</p></td>
	</tr>
</table>
<h3 align="center">Listado de Artículos</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="10%" style="color: white;">N°</th>
		<th width="20%" style="color: white;">Nombre</th>
		<th width="20%" style="color: white;">Código</th>
		<th width="20%" style="color: white;">Categoria</th>
		<th width="5%" style="color: white;">Stock</th>
		<th width="20%" style="color: white;">Descripción</th>
	</tr>
	</br>
	<?php $cont=1; ?>
	@foreach($articulos as $art)
	<tr>
		<td>{{$cont}}</td>
		<td>{{$art->nombre}}</td>
		<td>{{$art->codigo}}</td>
		<td>{{$art->categoria}}</td>
		<td>{{$art->stock}}</td>
		<td>{{$art->descripcion}}</td>
	</tr>
	<?php $cont= $cont + 1; ?>
	@endforeach
</table>	
</div>
</body>
</html>