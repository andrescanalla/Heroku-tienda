<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Dash extends Model
{
    protected $table= 'dash';

    protected $primaryKey= 'iddash';

    public $timestramp= true;


    protected $fillable = [
      'fecha',
      'Comment',
      'todo',      
    ];

    protected $guarded = [];

	public static function fechain($fechain){
	    $fecha="";
	    $carbon = new \Carbon\Carbon();
	    if(!empty($fechain)){
	        $fecha=$carbon->createFromFormat('Y-m-d',$fechain);
	        $fecha=$fecha->format('d/m');
	     }             
	                 
	    return ($fecha);      
	}

	public static function ventapedido($año){
		$año='2017';
        $m=1;
        $mes=[];
        while ( $m<= 12) {
            $mes [$m]=["01-$m-$año","31-$m-$año"];
            $m=$m+1;
        };
        $venta=[];
        foreach ($mes as $m) {
        	# code...
       
		$desde=new Carbon($m[0]);
		$hasta=new Carbon($m[1]);
		
	    $detaventa=DB::table('detalleventa as dv')
           ->join('stock as s','dv.id_stock','=','s.idstock')
           ->join('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           
           ->join('orden as o','de.id_orden','=','o.idorden')
           ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->join('venta as v','dv.id_venta','=','v.idventa')
           ->leftjoin('pedidos as ped','v.id_pedidos','=','ped.idpedidos')
           ->leftjoin('persona as per','v.id_persona','=','per.idpersona')
           
           ->select('iddetalleventa','pe.fechacompra')
           
           ->where('pe.fechacompra','>',$desde->format('Y-m-d'))
           ->where('pe.fechacompra','<',$hasta->format('Y-m-d')) 
           ->where('v.id_pedidos','!=',1)  
           ->where('per.usuario','!=','Marcela Viana')
           ->where('per.usuario','!=','Romina Morganti')            
           
           ->get();
        $detalleventa=$detaventa->count('iddetalleventa');
        
        array_push($venta, $detalleventa);
         }
        
        return ($venta);
           
    }
    public static function ventastock($año){
		$año='2017';
        $m=1;
        $mes=[];
        while ( $m<= 12) {
            $mes [$m]=["01-$m-$año","31-$m-$año"];
            $m=$m+1;
        };
        $venta=[];
        foreach ($mes as $m) {
        	# code...
       
		$desde=new Carbon($m[0]);
		$hasta=new Carbon($m[1]);
		
	    $detaventa=DB::table('detalleventa as dv')
           ->join('stock as s','dv.id_stock','=','s.idstock')
           ->join('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->join('producto as p','de.id_producto','=','p.idproducto')
           
           ->join('orden as o','de.id_orden','=','o.idorden')
           ->join('pedidos as pe','o.id_pedidos','=','pe.idpedidos')
           ->join('venta as v','dv.id_venta','=','v.idventa')
           ->leftjoin('pedidos as ped','v.id_pedidos','=','ped.idpedidos')
           
           ->select('iddetalleventa','v.fecha')
           
           ->where('v.fecha','>',$desde->format('Y-m-d'))
           ->where('v.fecha','<',$hasta->format('Y-m-d')) 
           ->where('v.id_pedidos','=',1)              
           
           ->get();
        $detalleventa=$detaventa->count('iddetalleventa');
        
        array_push($venta, $detalleventa);
         }
        
        return ($venta);
           
    }
}


