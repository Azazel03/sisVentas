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
<h3 align="center">Listado de Clientes</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="15%" style="color: white;">Nombre Completo</th>
		<th width="5%" style="color: white;">Tipo Documento</th>
		<th width="5%" style="color: white;">Número Documento</th>
		<th width="15%" style="color: white;">Dirección</th>
		<th width="10%" style="color: white;">Teléfono</th>
		<th width="15%" style="color: white;">Email</th>
	</tr>
	</br>
	@foreach($cliente as $client)
	<tr>
		<td>{{$client->nombre}}</td>
		<td>{{$client->tipo_documento}}</td>
		<td>{{$client->num_documento}}</td>
		<td>{{$client->direccion}}</td>
		<td>{{$client->telefono}}</td>
		<td>{{$client->email}}</td>
	</tr>
	@endforeach
</table>	
</div>
</body>
</html>