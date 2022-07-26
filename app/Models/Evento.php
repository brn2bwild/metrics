<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
      'nombre',
      'fecha_hora',
      'ciudad',
      'estado',
      'direccion',
      'descripcion',
      'redes_sociales',
      'url_pagina',
      'url_imagen',
      'url_evento',
      'id_usuario',
    ];
}
