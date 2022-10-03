<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Registro;
use Livewire\Component;

class AtletasInscritos extends Component
{
  public $evento;

  public function render() {
    return view('livewire.atletas-inscritos');
  }
}
