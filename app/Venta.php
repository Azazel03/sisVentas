<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta'; //indica que la clase llama a la tabla categoria
    protected $primaryKey='idventa'; //atributo que nos permite manejar un dato por su id
    public $timestamps=false; //dato obligatorio que permite manejar los tiempos

    protected $fillable=[ //array que maneja los atributos de la tabla categoria
    	'idcliente',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'total_venta',
    	'estado'
    ];

    protected $guarded=[
    	
    ];
}
