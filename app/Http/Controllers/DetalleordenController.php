<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DetalleordenFormRequest;
use App\Detalleorden;
use Illuminate\Support\Facades\Redirect;
use App\Stock;
use DB;

class DetalleordenController extends Controller
{
       public function __construct()
   {
   }
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $detalle=DB::table('detalleorden as de')
           ->join('orden as o','de.id_orden','=','o.idorden')
           ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->join('producto as pro','de.id_producto','=','pro.idproducto')
           ->join('tipos as tis','de.id_tipo','=','tis.idtipo')
           ->select('de.iddetalleorden','o.orden', 'pro.codebar','pro.producto','pro.talle','pe.nombre','pro.imagen','tis.tipo','de.cant','de.precio','de.chequeado')
           ->where('pro.producto','LIKE','%'.$query.'%')           
           ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
           ->orwhere('pro.codebar','LIKE','%'.$query.'%')
           ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
           ->orderBy('o.idorden','desc')
           ->get();

           $orden=DB::table('orden as or')          
           ->select('or.orden','or.idorden')
           ->orderBy('or.idorden','desc')
           ->get();

           $orden2=[""=>"Sin filtro..."];
           foreach ($orden as $key => $value) {
              $orden2 [$value->idorden]=$value->orden;
            }
          return view('compra.detalleorden.index',["detalle"=>$detalle,"searchText"=>$query,"orden2"=>$orden2]);
                     
        }
  }
  public function create()
{
    return view("compra.tipos.create");
}
public function store (Request $request)
{
    $detalleorden=new Detalleorden;
    $detalleorden->id_tipo=$request->get('tipo');
    $detalleorden->id_orden=$request->get('idorden');
    $detalleorden->id_producto=$request->get('idproducto');
    $detalleorden->cant=$request->get('cant');
    $detalleorden->precio=$request->get('precio');    
    $detalleorden->save();

    $stock=new Stock;
    $stock->id_detalleorden=$detalleorden->iddetalleorden;
    $stock->stock=$detalleorden->cant;
    $stock->estado="Comprado";
    $stock->save();
   
    return Redirect::back();

}
public function show($id)
{
    return view("compra.tipos.show",["estado"=>Tipos::findOrFail($id)]);
}
public function edit($id)
{   

    return view('compra.detalleorden.edit',["detalleorden"=>Detalleorden::findOrFail($id)]);
}
public function update(Request $request,$id)
{
    $detalleorden=Detalleorden::findOrFail($id);
    $detalleorden->cant=$request->get('cant');
    $detalleorden->precio=$request->get('precio');
    $detalleorden->update();
    
    return Redirect::back();
}
public function destroy(Request $request ,$id)
{
  if($request->get('delete')==1){
    $det=Detalleorden::findOrFail($request->get('idd'));    
    $det->delete();
  }
  else {

  $a=$request->get('tipo');
  
  
  if($a==0){
    $det=Detalleorden::findOrFail($request->get('idd'));    
    $det->delete();
  }
  if($a==1){
    $det=Detalleorden::findOrFail($request->get('idd'));      
    
    $stock=DB::table('stock')
      ->where('id_detalleorden', $request->get('idd'))
      ->where('estado',"Comprado")
      ->get();
    if ($stock->count()==0){
      return Redirect::back()->with('success', true)->with('message','No podes chequear mas prendas que las que compraste!!!');
    }
    else{
    $sto=stock::findOrFail($stock[0]->idstock);   
    $sto->estado="Chequeado";
    $sto->update();
    
    $x=$det->chequeado;
    $xx=$x+1;
    $det->chequeado=$xx;
    $det->update();
  }

  }
  if($a==3){
    $det=Detalleorden::findOrFail($request->get('idd'));       
    $stock=DB::table('stock')
      ->where('id_detalleorden', $request->get('idd'))
      ->where('estado',"Chequeado")
      ->get();
    if ($stock->count()==0){
      return Redirect::back()->with('success', true)->with('message','Hace bien los calculos!! tenes 0 prendas chequeadas!!!');
    }
    else{
    $sto=stock::findOrFail($stock[0]->idstock);   
    $sto->estado="Comprado";
    $sto->update();

    $x=$det->chequeado;    
    $xx=$x-1;    
    $det->chequeado=$xx;
    $det->update();
    }
  }
  }
  return Redirect::back();
  #return Redirect::to("compra/pedidos/$id");
}
}
