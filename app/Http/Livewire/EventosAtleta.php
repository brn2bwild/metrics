<?php

namespace App\Http\Livewire;

use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventosAtleta extends Component
{
  public function render() {
    return view('livewire.eventos-atleta',[
      'registros' => Registro::where('id_usuario', Auth::user()->id)->orderBy('id', 'DESC')->paginate(8)
    ]);
  }
}
