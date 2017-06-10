<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\VentaFormRequest;
use App\Detalleventa;
use App\Persona;
use App\Venta;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if ($request)
       {
         
           $query=trim($request->get('searchText'));
           $ventas=DB::table('venta as v')
            ->leftjoin('persona as pe','v.id_persona','=','pe.idpersona')
            ->leftjoin('pedidos as p','v.id_pedidos','=','p.idpedidos')
            ->leftjoin('detalleventa as dv','v.idventa','=','dv.id_venta')
            ->leftjoin('stock as s','dv.id_stock','=','s.idstock')
           
            ->select( 'pe.idpersona','v.vcomentario', 'v.idventa','pe.usuario','pe.nombres','v.fecha','p.nombre','v.id_pedidos','v.vestado',DB::raw('sum(dv.precio_venta) as precio'), DB::raw('count(dv.precio_venta) as cant'),DB::raw('sum((CASE WHEN (s.estado = "Chequeado" || s.estado = "Reservado") THEN "2" ELSE "1" END)) as cantche'))
            ->groupBy('pe.idpersona','v.vcomentario','v.idventa','pe.usuario','pe.nombres','v.fecha','p.nombre' ,'v.id_pedidos','v.vestado')
            ->where('usuario','LIKE','%'.$query.'%')
            ->where('id_pedidos','LIKE','%'.$request->get('tipo').'%')
            ->where('vestado','LIKE','%'.$request->get('estado').'%')                        
            ->orwhere('nombre','LIKE','%'.$query.'%') 
            ->where('id_pedidos','LIKE','%'.$request->get('tipo').'%')
            ->where('vestado','LIKE','%'.$request->get('estado').'%')                                
            ->orderBy('v.idventa','desc')
            ->get();

            $tipo=[""=>"Sin filtro..."];
        foreach ($ventas as $key => $value) {            
        $tipo [$value->id_pedidos]=$value->nombre;
         }
           $estado=[""=>"Sin filtro..."];
        foreach ($ventas as $key => $value) {            
        $estado [$value->vestado]=$value->vestado;
         }

         
           
            return view('ventas.venta.index',["tipo"=>$tipo,"estado"=>$estado,"ventas"=>$ventas,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $personas=DB::table('persona')
            ->get();
        
        $ped=DB::table('pedidos as p')
                ->where('id_tipo',1)
                ->orwhere('id_tipo',5)
                ->select('nombre','idpedidos')
                ->orderBy('idpedidos','desc' )
                ->take(2)
                ->get();
        
        

        $venta=new Venta;
            $venta->id_persona=1;
            $fecha=Carbon::now();
            $venta->fecha=$fecha->toDateTimeString();
            $venta->vestado="Confirmada";
            $venta->id_pedidos=$ped[0]->idpedidos;
            $venta->save();
            

        return Redirect::to("ventas/venta/$venta->idventa/edit");
               
             
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
            $venta=new Venta;
            $venta->id_persona=$request->get('idpersona');
            $fecha=Carbon::createFromFormat('d/m/Y',$request->get('fecha'));
            $venta->fecha=$fecha->toDateTimeString();
            $venta->vestado=$request->get('estado');
            $venta->id_pedidos=$request->get('tventa');
            $venta->save();

                       
       
        
        return Redirect::to("ventas/venta/$venta->idventa/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $detaven=DB::table('detalleventa as dv')
            ->join('stock as s','dv.id_stock','=','s.idstock')

            #->join('tipos as t','dv.id_tipo','=','t.idtipo')
            ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
            ->join('orden as o','do.id_orden','=','o.idorden')
             ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
            ->join('producto as p','do.id_producto','=','p.idproducto')
            ->join('venta as v','dv.id_venta','=','v.idventa')           
            ->select('s.estado', 'p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','dv.iddetalleventa', 'dv.id_venta', 'dv.precio_venta','v.id_pedidos',DB::raw('sum(dv.precio_venta) as precios'), DB::raw('count(dv.precio_venta) as cant'),DB::raw('(do.precio/do.cant*1.0712+pe.costo_unit_total+o.extra_unit)*pe.tasa as ctp'))
            ->groupBy('s.estado','p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','dv.iddetalleventa', 'dv.id_venta', 'dv.precio_venta','v.id_pedidos','do.precio','do.cant','pe.costo_unit_total','pe.tasa','o.extra_unit')
            ->where('id_venta',$id) 
            ->get();

        $ven=DB::table('venta')
            ->join('pedidos as ped','id_pedidos','=','ped.idpedidos')
            ->join('persona as pe','id_persona','=','pe.idpersona')
            ->join('detalleventa as dv','idventa','=','dv.id_venta')
            ->select('vcomentario','ped.nombre','pe.usuario','pe.nombres','vestado','fecha' ,'id_pedidos',DB::raw('sum(dv.precio_venta) as precio'), DB::raw('count(dv.precio_venta) as cant'))
            ->groupBy('vcomentario','ped.nombre','pe.usuario','pe.nombres','vestado','fecha' ,'id_pedidos')
            ->where('idventa',$id) 
            ->first();

        return view("ventas.venta.show",["detaven"=>$detaven,"ven"=>$ven]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $venta=DB::table('venta as v')
         ->join('persona as p','v.id_persona','=','p.idpersona')
         ->where('idventa', $id)
         ->first();


        $personas=DB::table('persona')
            ->get();
        
        $articulos=DB::table('stock as s')
            ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
            ->join('producto as p','do.id_producto','=','p.idproducto')
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','s.precio_v')
            ->where('s.idstock', $request->get('venta')) 
             ->where('s.stock', 1) 
            // filtro orden->where() 
            ->get();

            $pedd=DB::table('pedidos as p')
                ->where('id_tipo',1)
                ->orwhere('id_tipo',5)
                ->select('nombre','idpedidos')
                ->orderBy('idpedidos','desc' )
                ->take(2)
                ->get();
            $a=DB::table('pedidos as p')->where('idpedidos',1) ->select('nombre','idpedidos') ->get();
            
               $pedd[]=$a[0];
               
            foreach ($pedd as $key) {               
                    if($key->idpedidos==1){
                        $ped2 [$key->idpedidos]=$key->nombre;
                    }
                    else{
                        $ped2 [$key->idpedidos]="Pedido: $key->nombre";                   
                    }
            }
            
        
        $query=trim($request->get('searchText'));
        if($venta->id_pedidos!=1){
        
        $busca=DB::table('stock as s')
            ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
            ->join('producto as p','do.id_producto','=','p.idproducto')
            ->join('orden as o','do.id_orden','=','o.idorden')
            ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','s.estado', 'o.orden','o.idorden', 'pe.nombre','pe.idpedidos')
            ->where('codebar','LIKE','%'.$query.'%') 
            ->where('s.stock', 1)
            ->where('p.producto', 'LIKE','%'.$request->get('prod').'%')             
            ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
            ->where('p.talle', 'LIKE','%'.$request->get('talle')) 
            ->where('pe.idpedidos', $venta->id_pedidos) 
            ->orwhere('style','LIKE','%'.$query.'%')
            ->where('s.stock', 1) 
            ->where('p.producto', 'LIKE','%'.$request->get('prod').'%')
            ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
            ->where('p.talle', 'LIKE','%'.$request->get('talle'))
            ->where('pe.idpedidos', $venta->id_pedidos)   
            ->get();
        }
        else{

            $busca=DB::table('stock as s')
            ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
            ->join('producto as p','do.id_producto','=','p.idproducto')
            ->join('orden as o','do.id_orden','=','o.idorden')
            ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','s.estado', 'o.orden','o.idorden', 'pe.nombre','pe.idpedidos')
            ->where('codebar','LIKE','%'.$query.'%') 
            ->where('s.stock', 1)
            ->where('p.producto', 'LIKE','%'.$request->get('prod').'%')             
            ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
            ->where('p.talle', 'LIKE','%'.$request->get('talle'))            
            ->orwhere('style','LIKE','%'.$query.'%')
            ->where('s.stock', 1)
            ->where('p.producto', 'LIKE','%'.$request->get('prod').'%')
            ->where('o.idorden', 'LIKE','%'.$request->get('type').'%')
            ->where('p.talle', 'LIKE','%'.$request->get('talle'))               
            ->get();
        }

        $ped=DB::table('pedidos')
            ->select('nombre','idpedidos')
            ->orderBy('idpedidos','desc')
            ->take(2)
            ->get();

        
           
        
        $orden2=[""=>"Sin filtro..."];
         foreach ($busca as $key => $value) {
            
        $orden2 [$value->idorden]=$value->orden;
         }
        $ped1=[""=>"Sin filtro..."];
         foreach ($ped as $key) {            
        $ped1 [$key->idpedidos]=$key->nombre;
         }

        $talle1=[""=>"Sin filtro..."];
        foreach ($busca as $key => $value) {
        $talle1 [$value->talle]=$value->talle;
        }
        $prod1=[""=>"Sin filtro..."];
        foreach ($busca as $key => $value) {
        $prod1 [$value->producto]=$value->producto;
        }

         $detaven=DB::table('detalleventa as dv')
            ->join('stock as s','dv.id_stock','=','s.idstock')
            #->join('tipos as t','dv.id_tipo','=','t.idtipo')
            ->join('detalleorden as do','s.id_detalleorden','=','do.iddetalleorden')
            ->join('producto as p','do.id_producto','=','p.idproducto')
            ->join('venta as v','dv.id_venta','=','v.idventa')
            ->select('p.codebar','p.producto','p.talle','p.imagen','p.style','p.idproducto','s.idstock','s.estado', 'dv.iddetalleventa', 'dv.id_venta', 'dv.precio_venta','v.id_pedidos')
            ->where('id_venta',$id) 
            ->get();
        

        return view("ventas.venta.edit",["ped2"=>$ped2,"venta"=>$venta, "id"=>$id, "detaven"=>$detaven,"personas"=>$personas,"busca"=>$busca,"articulos"=>$articulos,"searchText"=>$query,"talle2"=>$talle1,"orden2"=>$orden2,"ped1"=>$ped1,"prod1"=>$prod1]);
    
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
        if($request->get('tipo')==2){
         $venta=Venta::findOrFail($request->get('id'));
         $venta->vestado->get('estado');
         $venta->update();  
         return Redirect::back(); 
        }
        $venta=Venta::findOrFail($id);
        $venta->id_persona=$request->get('idpersona');

        $fecha=Carbon::createFromFormat('d/m/Y',$request->get('fecha'));
        $venta->fecha=$fecha->toDateTimeString();
        $venta->vestado=$request->get('estado');
        $venta->id_pedidos=$request->get('tventa');
        $venta->vcomentario=$request->get('vcomentario');
        $venta->update();

        return Redirect::to('ventas/venta');


    }

    public function update2(Request $request)
    {
        if($request->get('tipo')==2){
         $venta=Venta::findOrFail($request->get('id'));
         $venta->vestado=$request->get('estado');
         $venta->update();  
         return Redirect::back(); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        //$venta->
        $venta->delete();
        return Redirect::to('ventas/venta');
    }

 public function vstock($id)
    {

            $nventa=new Venta;
            $nventa->id_persona=1;
            $fecha=Carbon::now();
            $nventa->fecha=$fecha->toDateTimeString();
            $nventa->vestado="Confirmada";
            $nventa->id_pedidos=1;
            $nventa->save();
            $a="'ventas/venta/$nventa->idventa/edit'";

        return Redirect::to("ventas/venta/$nventa->idventa/edit?searchText=&prod=&talle=&type=&venta=$id");
       
      
    }

     public function comment(Request $request)
    {

            $venta=Venta::findOrFail($request->get('id'));
            $venta->vcomentario=$request->get('comentarios');
            $venta->save();
            

        return Redirect::back(); 
       
      
    }



}
