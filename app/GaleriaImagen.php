<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriaImagen extends Model
{
  protected $table = "galeria_imagenes";
  public $primaryKey = "id";
  protected $fillable = [
   'detalle_comunidad_id',
   'imagen',
   'imagen_path',
   'titulo',
   'descripcion',
  ];
   public $timestamps = false;
}
