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
<h3 align="center">Listado de Ventas</h3>
<table id="tabla" border="2" cellspacing="0" cellpadding="1" align="center">
	<tr style="background-color: black;">
		<th width="5%" style="color: white;">N°</th>
		<th width="15%" style="color: white;">Fecha</th>
		<th width="20%" style="color: white;">Cliente</th>
		<th width="20%" style="color: white;">Comprobante</th>
		<th width="5%" style="color: white;">Impuesto</th>
		<th width="15%" style="color: white;">Total</th>
		<th width="5%" style="color: white;">Estado</th>
	</tr>
	</br>
	<?php $cont=1; ?>
	@foreach ($ventas as $ven)
	<tr>
		<td>{{ $cont }}</td>
		<td>{{ $ven->fecha_hora }}</td>
		<td>{{ $ven->nombre }}</td>
		<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante  }}</td>
		<td>{{ $ven->impuesto }}</td>
		<td>{{ $ven->total_venta }}</td>
		<td>{{ $ven->estado }}</td>
	</tr>
	<?php $cont= $cont + 1; ?>
	@endforeach
</table>	
</div>
</body>
</html>