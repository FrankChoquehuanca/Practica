<?php

namespace App\Livewire\Forms;

use App\Models\Gerencia;
use Livewire\Attributes\Rule;
use Livewire\Form;

class GerenciaForm extends Form{
    public ?Gerencia $gerencia;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;


    public function setPost(Gerencia $gerencia){
        $this->gerencia = $gerencia;
        $this->nombre = $gerencia->nombre;
        $this->descripcion = $gerencia->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
