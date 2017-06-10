<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Detalleventa;
use App\Stock;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;


class DetalleventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $query=trim($request->get('searchText'));          
       if(empty($request->get('hasta'))){
            $hasta=carbon::now();
           
       }
       else{
         $hasta=new Carbon;
         $hasta=$hasta->createFromFormat('d/m/Y',$request->get('hasta'));
        
       }
       if(empty($request->get('desde'))){
        $desde=new Carbon;
        $desde=$desde->createFromFormat('d/m/Y',"01/01/2015");
         
       }
       else{
        $desde=new Carbon();
        $desde=$desde->createFromFormat('d/m/Y',$request->get('desde'));
               
       }
     
     
       $detaventa=DB::table('detalleventa as dv')
           ->join('stock as s','dv.id_stock','=','s.idstock')
           ->join('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           ->join('categoria as ca','p.id_categoria','=','ca.idcategoria')
           ->join('estacion as es','p.id_estacion','=','es.idestacion')
           ->join('marca as ma','p.id_marca','=','ma.idmarca')
           ->join('tipo as ti','p.id_tipo','=','ti.idtipo')
           ->join('orden as o','de.id_orden','=','o.idorden')
           ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->join('venta as v','dv.id_venta','=','v.idventa')
           ->leftjoin('pedidos as ped','v.id_pedidos','=','ped.idpedidos')
           ->leftjoin('persona as per','v.id_persona','=','per.idpersona')
           ->select('pe.fechacompra', 'per.usuario', 'ped.nombre','v.id_pedidos', 'v.fecha', 'dv.iddetalleventa','dv.precio_venta', 's.idstock','p.codebar','p.imagen','p.producto','p.talle','p.style', 'ti.tipo', 'ca.categoria','es.estacion','ma.marca','s.stock','s.estado','o.orden',DB::raw('de.precio/de.cant as precio'),DB::raw('(de.precio/de.cant*1.0712+pe.costo_unit_total+o.extra_unit)*pe.tasa as ctp'))
           ->groupBy('pe.fechacompra','per.usuario','ped.nombre','v.id_pedidos','v.fecha','dv.iddetalleventa','dv.precio_venta','s.idstock','p.codebar','p.imagen','p.producto','p.talle','p.style', 'ti.tipo', 'ca.categoria','es.estacion','ma.marca','s.stock','s.estado','o.orden','de.precio','de.cant','pe.costo_unit_total','pe.tasa','o.extra_unit')
           ->where('p.producto','LIKE','%'.$query.'%')
           ->where('v.fecha','<',$hasta->toDateTimeString()) 
           ->where('v.fecha','>',$desde->toDateTimeString())
           ->where('v.id_pedidos','=',$request->get('tipo'))
           ->where('per.usuario','!=','Marcela Viana')               
           ->orwhere('p.talle','LIKE','%'.$query.'%')
           ->where('v.fecha','<',$hasta->toDateTimeString()) 
           ->where('v.fecha','>',$desde->toDateTimeString())
            ->where('v.id_pedidos','=',$request->get('tipo'))
            ->where('per.usuario','!=','Marcela Viana')   
           ->orwhere('per.usuario','LIKE','%'.$query.'%')
           ->where('v.fecha','<',$hasta->toDateTimeString()) 
           ->where('v.fecha','>',$desde->toDateTimeString())
            ->where('v.id_pedidos','LIKE','%'.$request->get('tipo'))
            ->where('per.usuario','!=','Marcela Viana')            
           ->orderBy('iddetalleventa','desc')
           ->get();

           $tipo=[""=>"Sin filtro..."];
        foreach ($detaventa as $key => $value) {            
        $tipo [$value->id_pedidos]=$value->nombre;
         }



            return view('ventas.Detalleventa.index',["hasta"=>$hasta,"desde"=>$desde,"tipo"=>$tipo,"detaventa"=>$detaventa,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detaventa=new Detalleventa;
        $detaventa->id_venta=$request->get('idventa');
        $detaventa->id_stock=$request->get('idstock');        
        $detaventa->precio_venta=$request->get('precio'); 
                 
        $detaventa->save();

        $sto=Stock::findOrFail($request->get('idstock'));
        $sto->stock=0;
        $sto->update();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detaventa=Detalleventa::findOrFail($id); 
            
        $detaventa->delete();

        $sto=Stock::findOrFail($detaventa->id_stock);
        $sto->stock=1;
        $sto->update();

        return Redirect::back();
    }
}
