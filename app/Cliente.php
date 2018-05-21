<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = "clientes";
  public $primaryKey = "id";
  protected $fillable = [
   'nombre',
   'imagen',
   'imagen_path'
  ];
   public $timestamps = false;
}
