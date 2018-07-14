<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;//permite que se pueda subir imagenes al servidor desde el cliente
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use DB;

class ArticuloController extends Controller
{
    	
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));//trim quita los espacios en blanco y esto nos permite buscar en la bd por articulo, a través d ela variable request que contiene el articulo
    		$articulos=DB::table('articulo as a')//la tabla articulo la realcionamos a la letra a
    		->join('categoria as c','a.idcategoria','=','c.idcategoria')//permite relacionar la tabla articulo con la tabla categoria
    		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')//indicamos que atributos queremos seleccionar
    		->where('a.nombre','LIKE','%'.$query.'%')//esta variable indica que en la tabla articulo donde el nombre en $query se buscará
    		->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('idarticulo','desc')//ordenado por
    		->paginate(7);//indica que la paginación sea de siete en siete registros en la vista
    		return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);//retorna una vista con los datos, en la ruta almacen/articulo/index, además a la vista se le envia ciertos paramnetros,searchText es el texto de busqueda
    	}
    }
    //este metodo retornara una vista llamada create.php
    public function create(){
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();//selecciona todos los registros de la tabla categoria donde la concidicon sea 1
    	return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    //funciuon que almacena datos en la bd,validando los datos con anterioridad
    public function store(ArticuloFormRequest $request){
    	$articulo=new Articulo;
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado='Activo';
    	//valida antes de enviar la imagen
    	if (Input::hasFile('imagen')){//hasFile() verifica si esta vacio
    		$file=Input::file('imagen');//almacenamos el objeto imagen en la variable file
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());//movelos la imagen a la carpeta imagenes/articulos, getClientOriginalName() obtiene el nombre de la imagen
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	$articulo->save();//esto almacena los datos que salen arriba en la bd
    	return Redirect::to('almacen/articulo');//retorna a esta vista
    }
    //function que sirve para mostrar datos, recibe el id de la categoria que se quiere mostrar
    public function show($id){
    	return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);//retorna una vista con la categoria
    }

    public function edit($id){
    	$articulo=Articulo::findOrFail($id);//esto permite seleccionar un articulo en especifico
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();//invoca todas las categorias que esten activas
    	return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);//retorna una vista con la categoria
    }
    //recibe un parametro para validar los datos en CategoriaFormRequest
    public function update(ArticuloFormRequest $request,$id){
    	$articulo = Articulo::findOrFail($id);
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');
    	//valida antes de enviar la imagen
    	if (Input::hasFile('imagen')){//hasFile() verifica si esta vacio
    		$file=Input::file('imagen');//almacenamos el objeto imagen en la variable file
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());//movelos la imagen a la carpeta imagenes/articulos, getClientOriginalName() obtiene el nombre de la imagen
    		$articulo->imagen=$file->getClientOriginalName();
    	}	
    	$articulo->update();//actualiza los datos en la bd
    	return Redirect::to('almacen/articulo');//redirecciona a esta vista
    }
    //destruir un objeto y eliminarlo de la bd, recibe como parametro una id
    public function destroy($id){
    	$articulo=Articulo::findOrFail($id);//busque la categoria donde la id se esta recibiendo por el parametro id
    	$articulo->estado='Inactivo';//cambia de estado de 1 a 0
    	$articulo->update();
    	return Redirect::to('almacen/articulo');
    }
}
