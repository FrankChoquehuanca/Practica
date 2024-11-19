<?php

namespace App\Livewire\Forms;

use App\Models\Cargoadicional;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CargoadicionalForm extends Form
{
    public ?Cargoadicional $cargoadicional;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;


    public function setPost(Cargoadicional $cargoadicional){
        $this->cargoadicional = $cargoadicional;
        $this->nombre = $cargoadicional->nombre;
        $this->descripcion = $cargoadicional->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
