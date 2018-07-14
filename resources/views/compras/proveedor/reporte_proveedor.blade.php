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
<h3 align="center">Listado de Proveedores</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="5%" style="color: white;">N°</th>
		<th width="20%" style="color: white;">Nombre</th>
		<th width="5%" style="color: white;">Tipo Doc</th>
		<th width="15%" style="color: white;">Número Doc.</th>
		<th width="15%" style="color: white;">Teléfono</th>
		<th width="15%" style="color: white;">Email</th>
	</tr>
	</br>
	<?php $cont=1; ?>
	@foreach ($personas as $per)
	<tr>
		<td>{{ $cont }}</td>
		<td>{{ $per->nombre }}</td>
		<td>{{ $per->tipo_documento }}</td>
		<td>{{ $per->num_documento }}</td>
		<td>{{ $per->telefono }}</td>
		<td>{{ $per->email }}</td>
	</tr>
	<?php $cont= $cont + 1; ?>
	@endforeach
</table>	
</div>
</body>
</html>