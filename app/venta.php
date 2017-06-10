<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    protected $table= 'venta';

  protected $primaryKey= 'idventa';

  public $timestramp= true;


  protected $fillable = [
    'id_persona',
    'comprobante',
    'fecha',
    'total_venta',
    'estdo'

    ];
}
