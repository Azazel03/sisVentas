<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria'; //indica que la clase llama a la tabla categoria
    protected $primaryKey='idcategoria'; //atributo que nos permite manejar un dato por su id
    public $timestamps=false; //dato obligatorio que permite manejar los tiempos

    protected $fillable=[ //array que maneja los atributos de la tabla categoria
    	'nombre',
    	'descripcion',
    	'condicion'
    ];  

    protected $guarded=[
    	
    ];
}
