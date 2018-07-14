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
<h3 align="center">Listado de Categorías</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="10%" style="color: white;">N°</th>
		<th width="40%" style="color: white;">Nombre</th>
		<th width="40%" style="color: white;">Descripción</th>
	</tr>
	</br>
	<?php $cont=1; ?>
	@foreach($categorias as $cat)
	<tr>
		<td>{{$cont}}</td>
		<td>{{$cat->nombre}}</td>
		<td>{{$cat->descripcion}}</td>
	</tr>
	<?php $cont= $cont + 1; ?>
	@endforeach
</table>	
</div>
</body>
</html>