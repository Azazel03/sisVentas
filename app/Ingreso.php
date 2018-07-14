<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso'; //indica que la clase llama a la tabla categoria
    protected $primaryKey='idingreso'; //atributo que nos permite manejar un dato por su id
    public $timestamps=false; //dato obligatorio que permite manejar los tiempos

    protected $fillable=[ //array que maneja los atributos de la tabla categoria
    	'idproveedor',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'estado'
    ];

    protected $guarded=[
    	
    ];
}
