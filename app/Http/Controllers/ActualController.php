<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ActualController extends Controller
{
	 public function __construct()
   {
   }
   public function index()
   {
     $ult=DB::table('detalleorden')
     	->select('updated_at')
     	->orderBy('updated_at','desc')
     	->first();

     $date = Carbon::now();	
     $date1=$date->subSecond(6);
     if ($ult->updated_at >$date1->toDateTimeString()) {

     $ultimo=DB::table('pedidos as pe')
           ->join('estado as e','pe.id_estado','=','e.idestado')
           ->join('orden as o','pe.idpedidos','=','o.id_pedidos')
           ->join('detalleorden as de','o.idorden','=','de.id_orden')
           ->join('tipos as ti','de.id_tipo','=','ti.idtipo')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           ->select('pe.idpedidos','p.codebar','p.style' ,'p.imagen','p.producto','p.talle','de.cant','de.precio','ti.tipo' ,'de.iddetalleorden','de.updated_at','de.chequeado', 'o.orden')
           ->orderBy('de.updated_at','desc')
           ->first();

           $venta=DB::table('stock as s')
          ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
          ->join('detalleventa as dv','s.idstock','=','dv.id_stock')
          ->join('venta as v','dv.id_venta','=','v.idventa')
          ->join('persona as p','v.id_persona','=','p.idpersona')
          ->select('p.usuario','v.idventa')
          ->where('do.iddetalleorden',$ultimo->iddetalleorden)
          ->get();
           return view("compra.actual.index",["ultimo"=>$ultimo, "venta"=>$venta]);
    }
   
    return false;

    }

public function show(Request $request, $id)
{
     $ult=DB::table('detalleorden')
      ->select('updated_at')
      ->orderBy('updated_at','desc')
      ->first();

     $date = Carbon::now(); 
     $date1=$date->subSecond(6);
     if ($ult->updated_at >$date1->toDateTimeString()) {

    $query=trim($request->get('searchText'));     
     $pedido=DB::table('pedidos as pe')
           ->join('estado as e','pe.id_estado','=','e.idestado')
           ->join('tipos as t','pe.id_tipo','=','t.idtipo')
           ->leftjoin('orden as o','pe.idpedidos','=','o.id_pedidos')
           ->select('pe.idpedidos','pe.nombre','t.tipo','pe.comentarios','pe.fechacompra','pe.fechadespacho','pe.fechallegada','e.estado')
           ->where('pe.idpedidos','=', $id)           
           ->first();


      $pedidos=DB::table('pedidos as pe')
           ->join('estado as e','pe.id_estado','=','e.idestado')
           ->join('tipos as t','pe.id_tipo','=','t.idtipo')
           ->join('orden as o','pe.idpedidos','=','o.id_pedidos')
           ->join('detalleorden as de','o.idorden','=','de.id_orden')
           ->join('tipos as ti','de.id_tipo','=','ti.idtipo')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           ->select('pe.idpedidos','p.idproducto','de.iddetalleorden','o.idorden','p.style','p.codebar','p.imagen','p.producto','p.talle','de.cant','de.precio','ti.tipo','de.chequeado', 'o.orden')
           ->where('pe.idpedidos','=', $id)   
           ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
           ->where('p.talle', 'LIKE','%'.$request->get('talle').'%')  
           ->where('p.codebar','LIKE','%'.$query.'%')  
           ->orderBy('de.chequeado','asc')
           ->orderBy('o.orden','desc')
           ->orderBy('p.producto','desc')         
           ->get();
                     
           
      $orden=DB::table('orden as or')          
          ->join('marca as ma','or.id_marca','=','ma.idmarca')
          ->join('detalleorden as det', 'or.idorden','=','det.id_orden')
          ->select('or.orden','or.idorden', 'ma.marca','or.fecha',DB::raw('sum(det.precio) as total'),DB::raw('sum(det.cant) as cant'))
          ->where('or.id_pedidos','=',$id)
          ->groupBy('or.orden','or.idorden','ma.marca','or.fecha')
          ->get();

      $orden2=[""=>"Sin filtro..."];
      foreach ($orden as $key => $value) {
        $orden2 [$value->idorden]=$value->orden;
      }
    
       
      $talle1=[""=>"Sin filtro..."];
      foreach ($pedidos as $key => $value) {
        $talle1 [$value->talle]=$value->talle;
      }
      
      
      
    return view("compra.actual.show",["pedido"=>$pedido,"orden2"=>$orden2 ,"talle2"=>$talle1, "pedidos"=>$pedidos, "searchText"=>$query]);
    }
    
    return false;

    
  }

    
}
