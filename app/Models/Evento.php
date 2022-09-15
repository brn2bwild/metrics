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
      'comentarios',
      'redes_sociales',
      'url_pagina',
      'url_imagen',
      'url_evento',
      'id_usuario',
    ];

    public function organizador() {
      return $this->belongsTo(User::class, 'id_usuario');
    }
    
    public function categorias() {
      return $this->hasMany(Categoria::class, 'id_evento');
    }

    public function registros() {
      return $this->hasMany(Registro::class, 'id_evento');
    }
}
