<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscriptores extends Model
{
  protected $table = "suscriptores";
  public $primaryKey = "id";
  protected $fillable = [
   'email'
  ];
   public $timestamps = true;

}
