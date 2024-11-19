<?php

namespace App\Livewire\Forms;

use App\Models\Subgerencia;
use Livewire\Attributes\Rule;
use Livewire\Form;

class SubgerenciaForm extends Form{
    public ?Subgerencia $subgerencia;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;

    public function setPost(Subgerencia $subgerencia){
        $this->subgerencia = $subgerencia;
        $this->nombre = $subgerencia->nombre;
        $this->descripcion = $subgerencia->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
