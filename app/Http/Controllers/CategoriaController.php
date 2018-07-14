<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Categoria; //invoca a la clase Categoria
use Illuminate\Support\Facades\Redirect; //permite hacer redirecciones
use sisVentas\Http\Requests\CategoriaFormRequest; //invoca el archivo request para manejar los datos que viajan del formulario
use DB; //permite trabajar con la clase DB de laravel


class CategoriaController extends Controller
{
	//constructor de la clase, nos permite validar 
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));//trim quita los espacios en blanco y esto nos permite buscar en la bd por categoria, a través d ela variable request que contiene la categoria
    		$categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')//esta variable indica que en la tabla categoria donde el nombre en $query se buscará
    		->where('condicion','=','1')//where que trae solo las categorias activas o con el numero 1 en la bd
    		->orderBy('idcategoria','desc')//ordenado por
    		->paginate(7);//indica que la paginación sea de siete en siete registros en la vista
    		return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);//retorna una vista con los datos, en la ruta almacen/categoria/index, además a la vista se le envia ciertos paramnetros,searchText es el texto de busqueda
    	}
    }
    //este metodo retornara una vista llamada create.php
    public function create(){
    	return view("almacen.categoria.create");
    }

    //funciuon que almacena datos en la bd,validando los datos con anterioridad
    public function store(CategoriaFormRequest $request){
    	$nombre=$request->get('nombre');
        $descripcion=$request->get('descripcion');
        $categoria = DB::select("call add_categoria('$nombre','$descripcion')");
        return Redirect::to('almacen/categoria');//retorna a esta vista
    }
    //function que sirve para mostrar datos, recibe el id de la categoria que se quiere mostrar
    public function show($id){
    	return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);//retorna una vista con la categoria
    }

    public function edit($id){
    	return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);//retorna una vista con la categoria
    }
    //recibe un parametro para validar los datos en CategoriaFormRequest
    public function update(CategoriaFormRequest $request,$id){
    	$categoria = Categoria::findOrFail($id);
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->update();//actualiza los datos en la bd
    	return Redirect::to('almacen/categoria');//redirecciona a esta vista
    }
    //destruir un objeto y eliminarlo de la bd, recibe como parametro una id
    public function destroy($id){
    	$categoria=Categoria::findOrFail($id);//busque la categoria donde la id se esta recibiendo por el parametro id
    	$categoria->condicion='0';
    	$categoria->update();
    	return Redirect::to('almacen/categoria');
    }
}
