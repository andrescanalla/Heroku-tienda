<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Detalleventa extends Model
{
    protected $table= 'detalleventa';

  protected $primaryKey= 'iddetalleventa';

  public $timestramp= true;


  protected $fillable = [
    'id_venta',
    'id_stock',
    'id_tipo',    
    'precio_venta'
    ];
}
