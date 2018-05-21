<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
  protected $table = "equipo";
  public $primaryKey = "id";
  protected $fillable = [
  'detalle_portafolio_id',
   'nombre',
   'descripcion',
   'imagen',
   'imagen_path'
  ];
   public $timestamps = false;
}
