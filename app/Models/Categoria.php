<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
      'nombre',
      'descripcion',
      'id_evento',
    ];

    public function evento () {
      return $this->belongsTo(Evento::class, 'id_evento');
    }

    public function wods() {
      return $this->hasMany(Wod::class, 'id_categoria');
    }
}
