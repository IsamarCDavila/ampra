<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriaSlick extends Model
{
  protected $table = "galeria_slick";
  public $primaryKey = "id";
  protected $fillable = [
   'detalle_portafolio_id',
   'imagen',
   'imagen_path',
  ];
   public $timestamps = false;
}
