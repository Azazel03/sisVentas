<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\IngresoFormRequest;
use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;
use DB;
use Carbon\Carbon; #permite trabajar con la fecha y hora de nuestra zona horaria
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
     //constructor de la clase, nos permite validar 
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$ingresos=DB::table('ingreso as i')
    		->join('persona as p','i.idproveedor','=','p.idpersona')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('i.idingreso','desc')
    		->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    		->paginate(7);
    		return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
    	$articulos=DB::table('articulo as art')
    	->select(DB::raw('CONCAT(art.codigo," ",art.nombre) AS articulo'),'art.idarticulo')
    	->where('art.estado','=','Activo')#muestra solo los articulos activos
    	->get();
    	return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);#retorna a la vista y envia los proveedores en personas y los articulos en articulos
    }

    public function store(IngresoFormRequest $request){
    	try{
    		DB::beginTransaction();#inicia una transaccion como se debe calcular un monto y enviar a dos tabls
    		$ingreso = new Ingreso;
    		$ingreso->idproveedor=$request->get('idproveedor');
    		$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
    		$ingreso->serie_comprobante=$request->get('serie_comprobante');
    		$ingreso->num_comprobante=$request->get('num_comprobante');
    		$mytime = Carbon::now('America/Santiago');
    		$ingreso->fecha_hora=$mytime->toDateTimeString();
    		$ingreso->impuesto='18';
    		$ingreso->estado='A';
    		$ingreso->save();
    		$idarticulo = $request->get('idarticulo');
    		$cantidad = $request->get('cantidad');
    		$precio_compra = $request->get('precio_compra');
    		$precio_venta = $request->get('precio_venta');
    		$cont=0;
    		while($cont < count($idarticulo)){#este while recorre los array de arriba, que son idarticulo en adelante
    			$detalle = new DetalleIngreso();
    			$detalle->idingreso=$ingreso->idingreso;
    			$detalle->idarticulo=$idarticulo[$cont];
    			$detalle->cantidad=$cantidad[$cont];
    			$detalle->precio_compra=$precio_compra[$cont];
    			$detalle->precio_venta=$precio_venta[$cont];
    			$detalle->save();
    			$cont = $cont + 1;
    		}
    		DB::commit();#cierra la transaccion
    	}catch(\Exception $e){
    		DB::rollback();#si hay algun problema con la red, la transaccion se elimina
    	}
    	return Redirect::to('compras/ingreso');
    }

    public function show($id){#va a mostrar los parametros de un ingreso en especifico a través de la variable id declarada
    	$ingreso = DB::table('ingreso as i')
    		->join('persona as p','i.idproveedor','=','p.idpersona')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.idingreso','=',$id)#este where es porque se necesita saber solo un ingreso
    		->first();#obtiene el primer dato que cumple lo que se pide en el select y where
    	$detalles= DB::table('detalle_ingreso as d') #muestra el detalle de el ingreso de arriba
    		->join('articulo as a','d.idarticulo','=','a.idarticulo')
    		->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
    		->where('d.idingreso','=',$id)
    		->get();
    	return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);	
    }

    #esta funcion es por si se desea cancelar el ingreso
    public function destroy($id){
    	$ingreso = Ingreso::findOrFail($id);#el objeto de ingreso coincide con la id
    	$ingreso->Estado='C';#se actualiza al estado cancelado
    	$ingreso->update();
    	return Redirect::to('compras/ingreso');
    }
}
