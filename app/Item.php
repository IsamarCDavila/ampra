<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = "items";
  public $primaryKey = "id";
  protected $fillable = [
   'titulo',
   'descripcion',
   'imagen',
   'imagen_path',
   'tipo'
  ];
   public $timestamps = false;
}
