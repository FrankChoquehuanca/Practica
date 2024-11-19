<?php

namespace App\Livewire\Forms;

use App\Models\Directorio;
use Livewire\Attributes\Rule;
use Livewire\Form;

class DirectorioForm extends Form
{
    public ?Directorio $directorio;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('nullable')]
    public $relacion_id;

    #[Rule('nullable')]
    public $cargoadicional_id;

    public function setPost(Directorio $directorio){
        $this->directorio = $directorio;
        $this->nombre = $directorio->nombre;
        $this->relacion_id = $directorio->relacion_id;
        $this->cargoadicional_id = $directorio->cargoadicional_id;
    }

    public function resetPost(){
        $this->reset();
    }
}

