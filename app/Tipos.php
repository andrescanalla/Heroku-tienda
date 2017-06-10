<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    protected $table= 'tipos';

    protected $primaryKey= 'idtipo';

    public $timestramp= true;


    protected $fillable = [
      'tipo',
      
    ];

    protected $guarded = [];
}
