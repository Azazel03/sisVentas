<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Persona;//aquí invocamos el modelo
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PersonaFormRequest; 
use DB;

class ClienteController extends Controller
{
    //constructor de la clase, nos permite validar 
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));//trim quita los espacios en blanco y esto nos permite buscar en la bd por categoria, a través d ela variable request que contiene la categoria
    		$personas=DB::table('persona')
    		->where('nombre','LIKE','%'.$query.'%')//esta variable indica que en la tabla persona donde el nombre en $query se buscará
    		->where('tipo_persona','=','Cliente')//where que trae solo las categorias activas o con el numero 1 en la bd
    		->orwhere('num_documento','LIKE','%'.$query.'%')//esta variable indica que en la tabla persona donde el numero de documento en $query se buscará
    		->where('tipo_persona','=','Cliente')//where que trae solo las categorias activas o con el numero 1 en la bd
    		->orderBy('idpersona','desc')//ordenado por
    		->paginate(7);//indica que la paginación sea de siete en siete registros en la vista
    		return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);//retorna una vista con los datos, en la ruta almacen/categoria/index, además a la vista se le envia ciertos paramnetros,searchText es el texto de busqueda
    	}
    }
    //este metodo retornara una vista llamada create.php
    public function create(){
    	return view("ventas.cliente.create");
    }
    //funciuon que almacena datos en la bd,validando los datos con anterioridad
    public function store(PersonaFormRequest $request){
    	$persona=new Persona;
    	$persona->tipo_persona='Cliente';//no atrapa del formulario porque la persona siempre va ha ser un cliente
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
    	$persona->save();//esto almacena los datos que salen arriba en la bd
    	return Redirect::to('ventas/cliente');//retorna a esta vista, que es el index de la vista persona
    }
    //function que sirve para mostrar datos, recibe el id de la categoria que se quiere mostrar
    public function show($id){
    	return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);//envia el parametro guardado en persona y retorna una vista con la categoria
    }

    public function edit($id){
    	return view("ventas.cliente.edit",["persona"=>Persona::findOrFail($id)]);//envia el parametro guardado en persona y retorna una vista con la categoria
    }
    //recibe un parametro para validar los datos en CategoriaFormRequest
    public function update(PersonaFormRequest $request,$id){//recibe la llave primaria del dato que se quiere actualizar
    	$persona = Persona::findOrFail($id);
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
    	$persona->update();//actualiza los datos en la bd
    	return Redirect::to('ventas/cliente');//redirecciona a esta vista
    }
    //destruir un objeto y eliminarlo de la bd, recibe como parametro una id
    public function destroy($id){
    	$persona=Persona::findOrFail($id);//busque la categoria donde la id se esta recibiendo por el parametro id
    	$persona->tipo_persona='Inactivo';
    	$persona->update();
    	return Redirect::to('ventas/cliente');
    }
}
