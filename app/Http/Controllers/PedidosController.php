<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PedidosFormRequest;
use App\Pedidos;
use App\Estado;
use App\Orden;
use App\Tipos;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PedidosController extends Controller
{
    public function __construct()
   {
   }

   
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $pedidos=DB::table('pedidos as pe')
           ->leftjoin('estado as e','pe.id_estado','=','e.idestado')
           ->leftjoin('tipos as t','pe.id_tipo','=','t.idtipo')
           ->leftjoin('orden as o','pe.idpedidos','=','o.id_pedidos')
           ->leftjoin('detalleorden as de','o.idorden','=','de.id_orden')
           ->select('pe.idpedidos','pe.nombre','t.tipo','pe.comentarios','pe.fechacompra','pe.fechadespacho','pe.fechallegada','e.estado','envio','pe.costo_unit_total',DB::raw('sum(o.extra_unit) as textra'),DB::raw('sum(de.precio)*1.0712 as total'),DB::raw('sum(de.cant)as cantt'))
           ->where('pe.nombre','LIKE','%'.$query.'%')
           ->orwhere('pe.fechacompra','LIKE','%'.$query.'%')
           ->orderBy('pe.fechacompra','desc')
           ->groupBy('pe.idpedidos','pe.nombre','t.tipo','pe.comentarios','pe.fechacompra','pe.fechadespacho','pe.fechallegada','e.estado','pe.envio','pe.costo_unit_total')
           ->paginate(7);

           
            
            return view('compra.pedidos.index',["pedidos"=>$pedidos,"searchText"=>$query]);

        }
  }
  public function create()
{
    $estado=DB::table('estado')->get();
    $tipos=DB::table('tipos')->get();
    $orden=DB::table('orden')
      /*->select('orden','idorden')*/
      ->get();

    return view("compra.pedidos.create", ["estado"=>$estado, "tipos"=>$tipos, "orden"=>$orden]);
}
public function store (PedidosFormRequest $request)
{
  try{
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
    }
    return Redirect::to('compra/pedidos');
}
public function show(Request $request, $id)
{
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
           
           ->select('pe.idpedidos','p.idproducto','de.iddetalleorden','o.idorden' , 'p.style', 'p.codebar','p.imagen','p.producto','p.talle','de.cant','de.precio','ti.tipo','de.chequeado', 'o.orden')
           ->where('pe.idpedidos','=', $id)   
           ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
           ->where('p.talle', 'LIKE','%'.$request->get('talle'))  
           ->where('p.codebar','LIKE','%'.$query.'%')  
           ->orderBy('de.chequeado','asc')
           ->orderBy('o.orden','desc')
           ->orderBy('p.producto','desc')         
           ->get();

           $ultimo=DB::table('pedidos as pe')
           ->join('estado as e','pe.id_estado','=','e.idestado')
           ->join('orden as o','pe.idpedidos','=','o.id_pedidos')
           ->join('detalleorden as de','o.idorden','=','de.id_orden')
           ->join('tipos as ti','de.id_tipo','=','ti.idtipo')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           ->select('pe.idpedidos','p.codebar','p.imagen','p.producto','p.style', 'p.talle','de.cant','de.precio','ti.tipo' ,'de.iddetalleorden','de.updated_at','de.chequeado', 'o.orden')
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
      
      
      
    return view("compra.pedidos.show",["venta"=>$venta,"pedido"=>$pedido,"orden2"=>$orden2 ,"ultimo"=>$ultimo,"talle2"=>$talle1, "pedidos"=>$pedidos, "searchText"=>$query]);
  }
public function edit($id)
{
    $pedidos=Pedidos::findOrFail($id);
    $estado=DB::table('estado')->get();
    $tipos=DB::table('tipos')->get();
    $orden=DB::table('orden as or')
          ->join('pedidos as pe','or.id_pedidos','=','pe.idpedidos')
          ->join('marca as ma','or.id_marca','=','ma.idmarca')
          ->join('detalleorden as det', 'or.idorden','=','det.id_orden')
          ->select('or.idorden', 'or.orden','ma.marca','or.fecha','pe.idpedidos','pe.tasa','pe.costo_unit_total','pe.encomienda', DB::raw('sum(det.precio) as total'),DB::raw('sum(det.cant) as cant'))
          ->where('pe.idpedidos','=',$id)
          ->groupBy('or.idorden', 'or.orden','ma.marca','or.fecha','pe.idpedidos','pe.tasa','pe.costo_unit_total','pe.encomienda')
          ->get();
    return view('compra.pedidos.edit',["pedidos"=>$pedidos,"estado"=>$estado, "tipos"=>$tipos, "orden"=>$orden]);
}
public function update(PedidosFormRequest $request,$id)
{
    $pedidos=Pedidos::findOrFail($id);
    $pedidos->nombre=$request->get('nombre');
    $pedidos->id_tipo=$request->get('id_tipo');
    $pedidos->comentarios=$request->get('comentarios');
    $fcc=Carbon::createFromFormat('d/m/Y',$request->get('fechacompra'));
    $pedidos->fechacompra=$fcc->format('Y-m-d'); 
    if(!empty($request->get('fechadespacho'))){
      $fdc=Carbon::createFromFormat('d/m/Y',$request->get('fechadespacho'));
      $pedidos->fechadespacho=$fdc->format('Y-m-d');}
    if(!empty($request->get('fechallegada'))){
      $flc=Carbon::createFromFormat('d/m/Y',$request->get('fechallegada'));
      $pedidos->fechallegada=$flc->format('Y-m-d');}            
    $pedidos->id_estado=$request->get('id_estado');
    $pedidos->envio=$request->get('envio');
    $pedidos->tasa=$request->get('tasa');
    $pedidos->encomienda=$request->get('encomienda');
    $pedidos->costo_unit_total=($request->get('envio')+($request->get('encomienda')/$request->get('tasa')))/$request->get('cantp');
    $pedidos->update();


    return Redirect::to('compra/pedidos');
}
public function destroy($id)
{
    $pedidos=Pedidos::findOrFail($id);
    
    $pedidos->delete();
    return Redirect::to('compra/pedidos');
}

public function venta(Request $request,$id){
  $venta=DB::table('stock as s')
          ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
          ->join('detalleventa as dv','s.idstock','=','dv.id_stock')
          ->join('venta as v','dv.id_venta','=','v.idventa')
          ->join('persona as p','v.id_persona','=','p.idpersona')
          ->select('p.usuario','p.nombres','v.idventa')
          ->where('do.iddetalleorden',$id)
          ->get();
   return view('compra.pedidos.venta',["venta"=>$venta]);

}


}

