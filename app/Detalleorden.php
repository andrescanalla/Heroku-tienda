<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleorden extends Model
{  protected $table= 'detalleorden';

    protected $primaryKey= 'iddetalleorden';

    public $timestramp= true;


    protected $fillable = [
      'id_orden',
      'id_producto',      
      'cant',
      'precio',
      'id_tipo',
      'chequeado',
       ];

    protected $guarded = [];
}
