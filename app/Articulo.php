<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo'; //indica que la clase llama a la tabla categoria
    protected $primaryKey='idarticulo'; //atributo que nos permite manejar un dato por su id
    public $timestamps=false; //dato obligatorio que permite manejar los tiempos

    protected $fillable=[ //array que maneja los atributos de la tabla categoria que se rellenan
    	'idcategoria',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'imagen',
    	'estado'
    ];
    //array guarded
    protected $guarded=[
    	
    ];
}
