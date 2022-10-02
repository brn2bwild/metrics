<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_usuario',
      'id_evento',
      'id_categoria',
      'tiempos',
      'nombre_equipo',
    ];

    public function usuario() {
      return $this->belongsTo(User::class, 'id_usuario');
    }

    public function evento() {
      return $this->belongsTo(Evento::class, 'id_evento');
    }

    public function categoria() {
      return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
