<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Detalleorden;
use App\Stock;

class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $cod=trim($request->get('codebar'));
        
         if(is_numeric(substr($cod, -1))){
          $cod=substr($cod,1);
         }

        
         else{
          $cod1=substr($cod,0,5);
          $cod2=substr($cod,5);
          $cod2=substr($cod2,0,-2);
          $cod2=trim($cod2);          
          $cod=$cod1."-".$cod2;
         }
                 
         $a=$request->get('idpedidos');
         $detalle=DB::table('detalleorden as de')
           ->leftjoin('orden as o','de.id_orden','=','o.idorden')
           ->leftjoin('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->leftjoin('producto as pro','de.id_producto','=','pro.idproducto')
           ->leftjoin('tipos as tis','de.id_tipo','=','tis.idtipo')
           ->select('de.iddetalleorden','o.orden', 'pro.codebar','pro.producto', 'pro.talle','pe.nombre','pe.idpedidos' ,'pro.imagen','tis.tipo','de.cant','de.precio','de.chequeado','pro.style')
           ->where('pe.idpedidos', $request->get('idpedidos'))  
           ->where('pro.codebar','LIKE',$cod)
           ->get();
          
           

           Return response()->json($detalle);

           #return view('compra.detalleorden.index',["detalle"=>$detalle,"searchText"=>$query,"orden2"=>$orden2]);
    }

    public function pedidos()
    {
           $pedidos=DB::table('pedidos')
           ->select('nombre','idpedidos')
           ->orderBy('idpedidos','desc')
           ->get();
           

           Return response()->json($pedidos);

           #return view('compra.detalleorden.index',["detalle"=>$detalle,"searchText"=>$query,"orden2"=>$orden2]);
    }

    public function venta(Request $request){
        $venta=DB::table('stock as s')
          ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
          ->join('detalleventa as dv','s.idstock','=','dv.id_stock')
          ->join('venta as v','dv.id_venta','=','v.idventa')
          ->join('persona as p','v.id_persona','=','p.idpersona')
          ->select('p.usuario')
          ->where('do.iddetalleorden',$request->get('id'))
          ->get();

        foreach ($venta as $key) {
            $ven[]=$key->usuario;
          }
           $img=DB::table('detalleorden as do')
          ->join('producto as p','do.id_producto','=','p.idproducto')         
          ->select('p.imagen')
          ->where('do.iddetalleorden',$request->get('id'))
          ->first();
        return view("ventas.venta.venta", ["venta"=>$venta,"img"=>$img]);
        #Return response()->json($ven);
      }

      public function imagen(Request $request){
        $imga=DB::table('detalleorden as do')
          ->join('producto as p','do.id_producto','=','p.idproducto')         
          ->select('p.imagen')
          ->where('do.iddetalleorden',$request->get('id'))
          ->first();

        
        #return view("ventas.venta.", ["venta"=>$venta]);
        return view("ventas.venta.imagen", ["venta"=>$venta]);
      }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $detalle=DB::table('detalleorden as de')
           ->leftjoin('orden as o','de.id_orden','=','o.idorden')
           ->leftjoin('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->leftjoin('producto as pro','de.id_producto','=','pro.idproducto')
           ->leftjoin('tipos as tis','de.id_tipo','=','tis.idtipo')
           ->select('de.iddetalleorden','o.orden', 'pro.codebar','pro.producto','pro.talle','pe.nombre','pe.idpedidos' ,'pro.imagen','tis.tipo','de.cant','de.precio','de.chequeado')
           ->where('pe.idpedidos', $id)  
           ->where('pro.codebar','LIKE',$request->get('codebar'))
           ->get();
           

           

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detalle=Detalleorden::findOrFail($id);

        $stock=DB::table('stock')
            ->where('id_detalleorden', $id)
            ->where('estado',"Comprado")
            ->get();
         if ($stock->count()==0){
         
         }
         else{
          $sto=stock::findOrFail($stock[0]->idstock);   
          $sto->estado="Chequeado";
          $sto->update();

          $detalle->chequeado=($detalle->chequeado+1);
          $detalle->update();
        }
        //agregar  para cambiar de comprado a chequeado o en stock en el campo estado de stock. - ver destroy de detalleorden - !!ya esta echo falta chequear!!!
        Return response()->json($detalle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
