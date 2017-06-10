<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detalleorden;
use DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Redirect;



class Pedidos extends Model
{
     protected $table= 'pedidos';

    protected $primaryKey= 'idpedidos';

    public $timestramp= true;


    protected $fillable = [
      'nombre',
      'id_tipo',
      'comentarios',
      'fechacompra',
      'fechadespacho',
      'fechallegada',
      'id_estado',
      
          ];

    protected $guarded = [];

  public static function filtroa($orden2){
    return array ($orden2);      
    }

  public static function fechain($fechain){
    $fecha="";
    $carbon = new \Carbon\Carbon();
    if(!empty($fechain)){
        $fecha=$carbon->createFromFormat('Y-m-d',$fechain);
        $fecha=$fecha->format('d/m/Y');
     }             
                 
    return ($fecha);      
    }

  

}
