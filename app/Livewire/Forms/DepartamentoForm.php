<?php

namespace App\Livewire\Forms;

use App\Models\Departamento;
use Livewire\Attributes\Rule;
use Livewire\Form;

class DepartamentoForm extends Form{
    public ?Departamento $departamento;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;

    public function setPost(Departamento $departamento){
        $this->departamento = $departamento;
        $this->nombre = $departamento->nombre;
        $this->descripcion = $departamento->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
