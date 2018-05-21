<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
  protected $table = "redes_sociales";
  public $primaryKey = "id";
  protected $fillable = [
   'icono',
   'icono_path',
   'nombre',
   'url'

  ];
   public $timestamps = false;

}
