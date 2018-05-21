<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $table = "banner";
  public $primaryKey = "id";
  protected $fillable = [
   'pagina_id',
   'titulo',
   'introduccion',
   'descripcion',
   'link',
   'button',
   'imagen',
   'imagen_path',
   'tipo_button'
  ];
   public $timestamps = false;
}
