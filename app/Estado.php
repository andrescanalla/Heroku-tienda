<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
      protected $table= 'estado';

    protected $primaryKey= 'idestado';

    public $timestramp= true;


    protected $fillable = [
      'estado',
      
    ];

    protected $guarded = [];
}
