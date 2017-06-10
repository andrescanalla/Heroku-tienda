<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Stock;
use App\Producto;
use Excel;
use App\Http\Requests\StockFormRequest;
use DB;

class StockController extends Controller
{  public function __construct()
   {
   }
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
                    
           $stocks=DB::table('stock as s')           
           ->leftjoin('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->leftjoin('producto as p','de.id_producto','=','p.idproducto')
           ->leftjoin('categoria as ca','p.id_categoria','=','ca.idcategoria')
           ->leftjoin('estacion as es','p.id_estacion','=','es.idestacion')
           ->leftjoin('marca as ma','p.id_marca','=','ma.idmarca')
           ->leftjoin('tipo as ti','p.id_tipo','=','ti.idtipo')
           ->leftjoin('orden as o','de.id_orden','=','o.idorden')
           ->leftjoin('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->select('s.idstock','s.precio_v','s.comentarios','p.codebar','p.imagen','p.idproducto','p.producto','p.talle','p.style', 'p.id_tipo','ti.tipo', 'p.id_categoria', 'ca.categoria','p.id_estacion','es.estacion','p.id_marca','ma.marca','s.stock','s.estado','o.orden','pe.nombre',DB::raw('(de.precio/de.cant*1.0712+pe.costo_unit_total+o.extra_unit)*pe.tasa as ctp'))
           ->groupBy('s.idstock','s.precio_v','s.comentarios','p.codebar','p.imagen','p.idproducto','p.producto','p.talle','p.style', 'p.id_tipo','ti.tipo', 'p.id_categoria', 'ca.categoria','p.id_estacion','es.estacion','p.id_marca','ma.marca','s.stock','s.estado','o.orden','pe.nombre','de.precio','de.cant','pe.costo_unit_total','pe.tasa','o.extra_unit')
           ->where('p.producto','LIKE','%'.$query.'%')
           ->where('s.stock',1)
           ->where('p.talle', 'LIKE','%'.$request->get('talle'))
           ->where('p.id_marca','LIKE','%'.$request->get('marca'))
           ->where('p.id_tipo','LIKE','%'.$request->get('tipo'))
           ->where('p.id_estacion','LIKE','%'.$request->get('est'))
           ->where('p.id_categoria','LIKE','%'.$request->get('cat'))
           ->where('s.estado','LIKE','%'.$request->get('estado'))           
           
           ->orwhere('p.codebar','LIKE','%'.$query.'%')
           ->where('s.stock',1)
           ->where('p.talle', 'LIKE','%'.$request->get('talle'))
           ->where('p.id_marca', 'LIKE','%'.$request->get('marca'))
           ->where('p.id_tipo', 'LIKE','%'.$request->get('tipo'))
           ->where('p.id_estacion','LIKE',$request->get('est'))
           ->where('p.id_categoria', 'LIKE','%'.$request->get('cat'))
           ->where('s.estado','LIKE','%'.$request->get('estado'))

           ->orwhere('p.id_tipo','LIKE','%'."6")
           ->where('p.producto','LIKE','%'.$query.'%')
           ->where('s.stock',1)
           ->where('p.talle', 'LIKE','%'.$request->get('talle'))
           ->where('p.id_marca','LIKE','%'.$request->get('marca'))           
           ->where('p.id_estacion','LIKE','%'.$request->get('est'))
           ->where('p.id_categoria','LIKE','%'.$request->get('cat'))
           ->where('s.estado','LIKE','%'.$request->get('estado'))           
           
           ->orwhere('p.id_tipo','LIKE','%'."6")
           ->where('p.codebar','LIKE','%'.$query.'%')
           ->where('s.stock',1)
           ->where('p.talle', 'LIKE','%'.$request->get('talle'))
           ->where('p.id_marca', 'LIKE','%'.$request->get('marca'))           
           ->where('p.id_estacion','LIKE',$request->get('est'))
           ->where('p.id_categoria', 'LIKE','%'.$request->get('cat'))
           ->where('s.estado','LIKE','%'.$request->get('estado'))


           ->orderBy('s.idstock','desc')
           ->get();
           
        $cat=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {            
        $cat [$value->id_categoria]=$value->categoria;
         }
          $estado=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {            
        $estado [$value->estado]=$value->estado;
         }
         $tipo=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {            
        $tipo [$value->id_tipo]=$value->tipo;
         }
         unset($tipo[6]);
          
          $est=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {            
        $est [$value->id_estacion]=$value->estacion;
         }

       
        $talle1=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {
        $talle1 [$value->talle]=$value->talle;
        }
        $marca=[""=>"Sin filtro..."];
        foreach ($stocks as $key => $value) {
        $marca [$value->id_marca]=$value->marca;
        }
            return view('stock.stock.index',["est"=>$est,"estado"=>$estado,"tipo"=>$tipo,"cat"=>$cat,"marca"=>$marca,"talle1"=>$talle1,"stocks"=>$stocks,"searchText"=>$query]);
        }
  }
  public function create()
{
    $productos=DB::table('producto')->get();
    return view("stock.stock.create", ["productos"=>$productos]);
}
public function store (StockFormRequest $request)
{
    $stock=new Stock;
    $stock->id_producto=$request->get('id_producto');
    $stock->stock=$request->get('stock');
    $stock->estado='true';
    $stock->save();
    return Redirect::to('stock/stock');

}
public function show($id)
{
    return view("stock.stock.show",["stock"=>Stock::findOrFail($id)]);
}
public function edit($id)
{
    $stock=Stock::findOrFail($id);
    $productos=DB::table('producto')->get();
    return view('stock.stock.edit',["stock"=>$stock,"productosxx"=>$productos]);
}
public function update(StockFormRequest $request,$id)
{
    $stock=Stock::findOrFail($id);
    $stock->id_producto=$request->get('id_producto');
    $stock->stock=$request->get('stock');
    $stock->estado=$request->get('estado');
    $stock->update();
    return Redirect::to('stock/stock');
}
public function destroy($id)
{
    $stock=Stock::findOrFail($id);
    $stock->estado='false';
    $producto->update();
    return Redirect::to('stock/stock');
}

public function update2(Request $request)
{
    $stock=Stock::findOrFail($request->get('id'));   
    if($request->get('tipo')==1){
    $stock->precio_v=$request->get('precio');    
    $stock->update();    
    }
    if($request->get('tipo')==2){
    $stock->estado=$request->get('estado');    
    $stock->update();    
    }
    if($request->get('tipo')==3){
    $stock->comentarios=$request->get('comentarios');    
    $stock->update();
    }
    return Redirect::back();
}
}