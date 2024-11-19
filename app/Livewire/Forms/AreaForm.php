<?php

namespace App\Livewire\Forms;

use App\Models\Area;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AreaForm extends Form
{
    public ?Area $area;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required|min:3')]
    public $descripcion;


    public function setPost(Area $area){
        $this->area = $area;
        $this->nombre = $area->nombre;
        $this->descripcion = $area->descripcion;
    }

    public function resetPost(){
        $this->reset();
    }
}
