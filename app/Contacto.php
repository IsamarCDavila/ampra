<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
  protected $table = "contacto";
  public $primaryKey = "id";
  protected $fillable = [
   'nombre',
   'apellido',
   'empresa',
   'email',
   'telefono',
   'mensaje',
   'metros',
   'distrito',
   'descarga'
   // 'id_pagina',
  ];
   public $timestamps = true;
}
