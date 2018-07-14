<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Articulo;
use sisVentas\Categoria;
use sisVentas\Ingreso;
use sisVentas\Persona;
use sisVentas\Venta;
use PDF;
use DB;

class PdfController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    public function pdf_cliente(){
    	$cliente=DB::table('persona')
    	->where('tipo_persona','=','Cliente')
    	->orderBy('idpersona','desc')//ordenado por
    	->paginate(12);
    	$pdf = PDF::loadView('ventas.cliente.reporte_cliente',['cliente' => $cliente]);
    	return $pdf->download('reporte_clientes.pdf');
    }

    public function pdf_articulo(){
    	$articulos=DB::table('articulo as a')//la tabla articulo la realcionamos a la letra a
    	->join('categoria as c','a.idcategoria','=','c.idcategoria')//permite relacionar la tabla articulo con la tabla categoria
    	->select('a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')//indicamos que atributos queremos seleccionar
    	->where('a.estado','=','Activo')
        ->orderBy('idarticulo','desc')//ordenado por
    	->paginate(12);
    	$pdf = PDF::loadView('almacen.articulo.reporte_articulo',['articulos' => $articulos]);
    	return $pdf->download('reporte_articulos.pdf');
    }

    public function pdf_categoria(){
    	$categorias=DB::table('categoria')
    	->where('condicion','=','1')
    	->orderBy('idcategoria','desc')
    	->paginate(12);
    	$pdf = PDF::loadView('almacen.categoria.reporte_categoria',['categorias' => $categorias]);
    	return $pdf->download('reporte_categorias.pdf');
    }

    public function pdf_ingreso(){
    	$ingresos=DB::table('ingreso as i')
    	->join('persona as p','i.idproveedor','=','p.idpersona')
    	->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    	->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    	->orderBy('i.idingreso','desc')
    	->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    	->paginate(12);
    	$pdf = PDF::loadView('compras.ingreso.reporte_ingreso',['ingresos' => $ingresos]);
    	return $pdf->download('reporte_ingresos.pdf');
    }

    public function pdf_proveedor(){
    	$personas=DB::table('persona')
    	->where('tipo_persona','=','Proveedor')//where que trae solo las categorias activas o con el numero 1 en la bd
    	->orderBy('idpersona','desc')//ordenado por
    	->paginate(12);//indica que la paginación sea de siete en siete registros en la vista
    	$pdf = PDF::loadView('compras.proveedor.reporte_proveedor',['personas' => $personas]);
    	return $pdf->download('reporte_proveedor.pdf');
    }

    public function pdf_venta(){
    	$ventas=DB::table('venta as v')
    	->join('persona as p','v.idcliente','=','p.idpersona')
    	->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    	->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
    	->orderBy('v.idventa','desc')
    	->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
    	->paginate(12);
    	$pdf = PDF::loadView('ventas.venta.reporte_venta',['ventas' => $ventas]);
    	return $pdf->download('reporte_ventas.pdf');
    }

    public function pdf_user(){
    	$usuarios=DB::table('users')
    	->orderBy('id','desc')
    	->paginate(12);
    	$pdf = PDF::loadView('seguridad.usuario.reporte_user',['usuarios' => $usuarios]);
    	return $pdf->download('reporte_usuarios.pdf');
    }

    public function pdf_ayuda(){
    	$pdf = PDF::loadView('help');
    	return $pdf->download('ayuda.pdf');
    }
}
