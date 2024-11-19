<?php

namespace App\Livewire\Forms;

use App\Models\Papeleta;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PapeletaForm extends Form
{
    public ?Papeleta $papeleta;

    #[Rule('required|min:3')]
    public $nombres,$gerencia,$salida,$retorno,$lugares,$observaciones,$fecha,$jefeinmediato;

    #[Rule('required')]
    public $monitoreo_id;
    #[Rule('required')]
    public $motivos;


    public function setPost(Papeleta $papeleta)
    {
        $this->papeleta = $papeleta;
        $this->nombres = $papeleta->nombres;
        $this->gerencia = $papeleta->gerencia;
        $this->salida = $papeleta->salida;
        $this->retorno = $papeleta->retorno;
        $this->motivos = $papeleta->motivos; // Decodifica los motivos desde JSON
        $this->lugares = $papeleta->lugares;
        $this->observaciones = $papeleta->observaciones;
        $this->fecha = $papeleta->fecha;
        $this->jefeinmediato = $papeleta->jefeinmediato;
        $this->monitoreo_id = $papeleta->monitoreo_id;
    }

    public function resetPost(){
        $this->reset();
    }
}
