<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table= 'orden';

    protected $primaryKey= 'idorden';

    public $timestramp= true;


    protected $fillable = [
      'id_pedidos',
      'orden',
      'id_marca',
      'fecha',
      'cant',
      'total',
      
    ];

    protected $guarded = [];
}


