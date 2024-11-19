<?php

namespace App\Livewire\Forms;

use App\Models\Unidad;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UnidadForm extends Form
{
    public ?Unidad $unidad;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;


    public function setPost(Unidad $unidad){
        $this->unidad = $unidad;
        $this->nombre = $unidad->nombre;
        $this->descripcion = $unidad->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
