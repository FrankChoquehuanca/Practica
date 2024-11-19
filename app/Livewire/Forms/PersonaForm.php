<?php

namespace App\Livewire\Forms;

use App\Models\Persona;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PersonaForm extends Form
{
    public ?Persona $persona;

    #[Rule('required|min:3')]
    public $nombres;
    #[Rule('required|min:3')]
    public $apellidos;
    #[Rule('required|min:3')]
    public $direccion;
    #[Rule('required|min:3')]
    public $celular;
    #[Rule('required|digits:8')]
    public $dni;
    #[Rule('required|min:3|email')]
    public $gmail;
    #[Rule('required|min:3')]
    public $estado_civil;
    #[Rule('required|min:3')]
    public $genero;

    public function setPost(Persona $persona){
        $this->persona = $persona;
        $this->nombres = $persona->nombres;
        $this->apellidos = $persona->apellidos;
        $this->direccion = $persona->direccion;
        $this->celular = $persona->celular;
        $this->dni = $persona->dni;
        $this->gmail = $persona->gmail;
        $this->estado_civil = $persona->estado_civil;
        $this->genero = $persona->genero;
    }

    public function resetPost(){
        $this->reset();
    }
}
