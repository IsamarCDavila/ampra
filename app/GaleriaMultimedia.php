<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriaMultimedia extends Model
{
  protected $table = "galeria_multimedia";
  public $primaryKey = "id";
  protected $fillable = [
   'detalle_portafolio_id',
   'imagen',
   'imagen_path',
   'titulo',
   'descripcion',
   'video',
  ];
   public $timestamps = false;
}
