<?php

namespace App\Livewire\Forms;

use App\Models\Turno;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TurnoForm extends Form
{
    public ?Turno $turno;

    #[Rule('required|min:3')]
    public $nombre;

    #[Rule('required')]
    public $horainicio;
    #[Rule('required')]
    public $horafinal;


    public function setPost(Turno $turno){
        $this->turno = $turno;
        $this->nombre = $turno->nombre;
        $this->horainicio = $turno->horainicio;
        $this->horafinal = $turno->horafinal;
    }

    public function resetPost(){
        $this->reset();
    }
}
