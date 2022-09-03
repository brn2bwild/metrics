<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wod extends Model
{
    use HasFactory;

    protected $fillable = [
      'nombre',
      'descripcion',
      'tipo',
      'time_cap',
      'id_categoria',
    ];

    public function categoria () {
      return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
