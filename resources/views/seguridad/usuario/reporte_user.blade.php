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
<h3 align="center">Listado de Usuarios</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="5%" style="color: white;">N°</th>
		<th width="45%" style="color: white;">Nombre</th>
		<th width="50%" style="color: white;">Email</th>
	</tr>
	</br>
	<?php $cont=1; ?>
	@foreach ($usuarios as $usu)
	<tr>
		<td>{{ $cont }}</td>
		<td>{{ $usu->name }}</td>
		<td>{{ $usu->email }}</td>
	</tr>
	<?php $cont= $cont + 1; ?>
	@endforeach
</table>	
</div>
</body>
</html>