<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  protected $table= 'stock';

  protected $primaryKey= 'idstock';

  public $timestramp= true;


  protected $fillable = [
    'id_producto',
    'stock',
    'estado',
    'updated_at'
    ];
}
