<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePortafolio extends Model
{
  protected $table = "detalle_portafolio";
  public $primaryKey = "id";
  protected $fillable = [
   'pagina_id',
   'nombre',
   'introduccion',
   'titulo',
   'descripcion_corta',
   'descripcion_larga',
   'imagen',
   'imagen_path',
   'menu',
   'slug'
  ];
   public $timestamps = false;

   public function beneficios()
   {
       return $this->hasMany('App\Beneficio', 'detalle_portafolio_id', 'id');
   }
   public function multimedia()
   {
        return $this->hasMany('App\GaleriaMultimedia', 'detalle_portafolio_id', 'id');
   }
   public function imagenes()
   {
        return $this->hasMany('App\GaleriaSlick', 'detalle_portafolio_id', 'id');
   }
}
