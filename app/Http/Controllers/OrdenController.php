<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use App\Http\Requests\OrdenFormRequest;
use App\Orden;
use App\Pedidos;
use App\Producto;
use App\Detalleorden;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class OrdenController extends Controller
{
     public function __construct()
   	{
   	}
   public function index(Request $request)
   	{
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $orden=DB::table('orden as o')
           ->leftjoin('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->leftjoin('marca as ma','o.id_marca','=','ma.idmarca')
           ->leftjoin('detalleorden as det','o.idorden','=','det.id_orden')
           ->select('o.idorden','o.orden', 'pe.nombre','ma.marca','o.fecha',DB::raw('sum(det.precio)*1.0712+o.extra as total'),DB::raw('sum(det.cant) as cant'))
           ->where('o.orden','LIKE','%'.$query.'%')           
           ->orwhere('pe.nombre','LIKE','%'.$query.'%')
           ->orderBy('o.fecha','desc')
           ->groupBy('o.idorden','o.orden', 'pe.nombre','ma.marca','o.fecha','o.extra')
           ->get();
            return view('compra.orden.index',["orden"=>$orden,"searchText"=>$query]);
        }
  	 }

    public function create()
{
    $detord=DB::table('detalleorden')->get();
    $pedidos=DB::table('pedidos')->get();
    $marca=DB::table('marca')->get();
    $orden=DB::table('orden')
      /*->select('orden','idorden')*/
      ->get();

    return view("compra.orden.create", ["pedidos"=>$pedidos, "marca"=>$marca, "orden"=>$orden, "detord"=>$detord]);
}
public function store (Request $request)
{
   $orden=new Orden;
   $orden->orden=$request->get('orden');
   $orden->id_marca=$request->get('marca');
   $orden->id_pedidos=$request->get('pedido');
   $fc=Carbon::createFromFormat('d/m/Y',$request->get('fecha'));
   $orden->fecha=$fc->format('Y-m-d');
   
   $orden->save();

  /*-->try{
      DB::beginTransaction();
      $pedidos=new Pedidos;
      $pedidos->nombre=$request->get('nombre');
      $pedidos->id_tipo=$request->get('id_tipo');
      $pedidos->comentarios=$request->get('comentarios');
      $fc=Carbon::createFromFormat('d/m/Y',$request->get('fechacompra'));
      if(!empty($request->get('fechadespacho'))){
      $fd=Carbon::createFromFormat('d/m/Y',$request->get('fechadespacho'));
      $pedidos->fechadespacho=$fd->format('Y-m-d');}
      if(!empty($request->get('fechallegada'))){
      $fl=Carbon::createFromFormat('d/m/Y',$request->get('fechallegada'));
      $pedidos->fechallegada=$fl->format('Y-m-d');}    
      $pedidos->fechacompra=$fc->format('Y-m-d');     
      $pedidos->id_estado=$request->get('id_estado');
      $pedidos->save();

      $idorden=$request->get('orden');
      $id_marca=$request->get('marca');
      $fecha=$request->get('fecha');
      $cant=$request->get('cant');
      $totalor=$request->get('totalorden');

      $cont=0;

      while($cont <count($idorden)){
        $orden= new Orden();
        $orden->id_pedidos=$pedidos->idpedidos;
        $orden->orden=$ord[$cont];
        $orden->id_marca=$id_marca[$cont];
        $orden->fecha=$fecha[$cont];
        $orden->cant=$cant[$cont];
        $orden->total=$totalor[$cont];
        $orden->save();
        $cont=$cont+1;
      }

      

      DB::commit();

  }catch(\Exception $e){
      DB::rollback();
    }*/
    return Redirect::to('compra/orden');
}
public function show(Request $request, $id)
{
      $orden1=DB::table('orden')             
           ->where('idorden',$id)           
           ->first();

      $query=trim($request->get('searchText'));
          $orden=DB::table('orden')
           ->leftjoin('detalleorden as de','idorden','=','de.id_orden')
           ->leftjoin('producto as pro','de.id_producto','=','pro.idproducto')
           ->leftjoin('tipos as tis','de.id_tipo','=','tis.idtipo')
           ->select('idorden','de.iddetalleorden', 'pro.codebar','pro.style','pro.producto','pro.talle','pro.imagen','tis.tipo','de.cant','de.precio','de.chequeado')
           ->where('pro.producto','LIKE','%'.$query.'%')           
           ->where('idorden',$id)
           ->where('pro.talle', 'LIKE','%'.$request->get('talle').'%') 
           ->orwhere('pro.codebar', 'LIKE','%'.$query.'%')
           ->where('idorden',$id)
           ->where('pro.talle', 'LIKE','%'.$request->get('talle').'%') 
           ->orderBy('iddetalleorden','desc')
           ->get();

           $talle1=[""=>"Sin filtro..."];
      foreach ($orden as $key => $value) {
        $talle1 [$value->talle]=$value->talle;
      }
           

    return view("compra.orden.show",["talle1"=>$talle1,"orden1"=>$orden1,"orden"=>$orden,"searchText"=>$query]);
  }
public function edit(Request $request, $id)
{
    $orden=Orden::findOrFail($id);
    $marca=DB::table('marca')->get();
    $tipo=DB::table('tipos')->get();
    $pedidos=DB::table('pedidos')
      ->select('idpedidos','nombre')
      ->get();

    $detaord=DB::table('detalleorden as do')           
            ->join('orden as o','do.id_orden','=','o.idorden')
            ->join('stock as s','do.iddetalleorden','=','s.id_detalleorden')
            ->join('producto as p','do.id_producto','=','p.idproducto')            
            ->select('s.idstock', 'p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto', 'do.iddetalleorden', 'do.id_orden', 'do.precio','do.cant')
            ->where('id_orden',$id) 
            ->get();

     $articulos=DB::table('producto as p')
            
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto')
            ->where('p.idproducto', $request->get('venta')) 
            
            // filtro orden->where() 
            ->get();

      $query=trim($request->get('searchText'));
       $busca=DB::table('producto as p')
            ->join('marca as ma','p.id_marca','=','ma.idmarca')
            ->join('tipo as ti','p.id_tipo','=','ti.idtipo')
            ->join('categoria as ca','p.id_categoria','=','ca.idcategoria')
            ->join('estacion as es','p.id_estacion','=','es.idestacion')            
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','ma.marca', 'ma.idmarca', 'p.id_marca','ti.tipo', 'ca.categoria','es.estacion')
            ->where('codebar','LIKE','%'.$query.'%')             
            ->where('p.id_marca', 'LIKE','%'.$request->get('marca').'%')        
                
            ->orwhere('style','LIKE','%'.$query.'%')
            ->where('p.id_marca', 'LIKE','%'.$request->get('marca').'%')       
            ->orderBy('idproducto', 'desc')           
            ->get();
       $marca1=[""=>"Sin filtro..."];
         foreach ($busca as $key => $value) {
            
        $marca1 [$value->idmarca]=$value->marca;
         }
         $tipo1=[];
         foreach ($tipo as $key => $value) {
            
        $tipo1 [$value->idtipo]=$value->tipo;
         }
    
    return view('compra.orden.edit',["tipo1"=>$tipo1, "busca"=>$busca,"orden"=>$orden, "marca1"=>$marca1,"marca"=>$marca, "pedidos"=>$pedidos, "detaord"=>$detaord, "articulos"=>$articulos,"id"=>$id,"searchText"=>$query]);
}
public function update(OrdenFormRequest $request,$id)
{
    $det=DB::table('detalleorden')
      ->select(DB::raw('sum(cant) as cant'))
      ->where('id_orden',$id)
      ->first();


    $orden=Orden::findOrFail($id);
    $orden->orden=$request->get('orden');
    $orden->id_pedidos=$request->get('id_pedidos');
    $orden->id_marca=$request->get('id_marca');
    if(!empty($request->get('fecha'))&&" "!=$request->get('fecha')){
      $fdc=Carbon::createFromFormat('d/m/Y',trim($request->get('fecha')));
    $orden->fecha=$fdc->format('Y-m-d');}
    $orden->extra=$request->get('extra');
    $orden->extra_unit=($request->get('extra')/$det->cant);
    $orden->update();

    return Redirect::to('compra/orden');
}
public function destroy($id)
{
    $orden=Orden::findOrFail($id);
    
    $orden->delete();
    return Redirect::to('compra/orden');
}
}




