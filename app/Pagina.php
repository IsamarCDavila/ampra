<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
  protected $table = "paginas";
  public $primaryKey = "id";
  protected $fillable = [
   'slug',
   'menu',
   'parent',
   'imagen',
   'imagen_path',
   'button',
   'titulo',
   'descripcion',
   'link',
  ];
   public $timestamps = false;
}
