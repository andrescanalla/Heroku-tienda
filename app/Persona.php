<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table= 'persona';

    protected $primaryKey= 'idpersona';

    public $timestramp= false;


    protected $fillable = [
      'usuario',
      'nombre',
      'cel',
      'direccion',
      'comentarios',
      'estado',
          ];

    protected $guarded = [];
    //
}
