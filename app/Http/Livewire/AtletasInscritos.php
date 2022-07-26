<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AtletasInscritos extends Component
{
  public $evento;

  public function render()
  {
    return view('livewire.atletas-inscritos');
  }
}
