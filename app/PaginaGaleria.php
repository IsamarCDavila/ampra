<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaginaGaleria extends Model
{
  protected $table = "paginas_galeria";
  public $primaryKey = "id";
  protected $fillable = [
   'pagina_id',
   'imagen',
   'imagen_path'
  ];
   public $timestamps = false;
}
