<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table='detalle_venta'; //indica que la clase llama a la tabla categoria
    protected $primaryKey='iddetalle_venta'; //atributo que nos permite manejar un dato por su id
    public $timestamps=false; //dato obligatorio que permite manejar los tiempos

    protected $fillable=[ //array que maneja los atributos de la tabla categoria
    	'idventa',
    	'idarticulo',
    	'cantidad',
    	'precio_venta',
    	'descuento'
    ];

    protected $guarded=[
    	
    ];
}
