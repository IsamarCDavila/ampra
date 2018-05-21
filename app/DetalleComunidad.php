<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleComunidad extends Model
{
  protected $table = "detalle_comunidad";
  public $primaryKey = "id";
  protected $fillable = [
  'detalle_portafolio_id',
   'titulo',
   'descripcion',
   'fecha',
   'imagen',
   'imagen_path',
   'hora_inicial',
   'hora_final',
   'lugar',
   'link_button',
   'estado',
   'tipo',
   'slug'
  ];
   public $timestamps = false;
}
