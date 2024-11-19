<?php

namespace App\Livewire\Forms;

use App\Models\Asignacion;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AsignacionForm extends Form
{
    public ?Asignacion $asignacion;

    #[Rule('required|min:3')]
    public $observaciones;

    #[Rule('required')]
    public $estado;

    #[Rule('required')]
    public $fechainicio;

    #[Rule('required')]
    public $fechafinal;

    #[Rule('required')]
    public $persona_id;
    #[Rule('nullable')]
    public $user_id;
    #[Rule('required')]
    public $directorio_id;

    public function setPost(Asignacion $asignacion){
        $this->asignacion = $asignacion;
        $this->observaciones = $asignacion->observaciones;
        $this->estado = $asignacion->estado;
        $this->fechainicio = $asignacion->fechainicio;
        $this->fechafinal = $asignacion->fechafinal;
        $this->persona_id = $asignacion->persona_id;
        $this->user_id = $asignacion->user_id;
        $this->directorio_id = $asignacion->directorio_id;
    }

    public function resetPost(){
        $this->reset();
    }
}
