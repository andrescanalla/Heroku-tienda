<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table= 'producto';

    protected $primaryKey= 'idproducto';

    public $timestramp= true;


    protected $fillable = [
      'codebar',
      'producto',
      'talle',
      'id_categoria',
      'id_estacion',
      'id_tipo',
      'style',
      'imagen',
      'id_marca',
      'updated_at',
    ];

    protected $guarded = [];
    //
}
