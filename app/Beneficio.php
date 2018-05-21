<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
  protected $table = "beneficios";
  public $primaryKey = "id";
  protected $fillable = [
   'detalle_portafolio_id',
   'detalle',
   'cifra',
  ];
   public $timestamps = false;
}
