<?php

namespace App\Livewire\Forms;

use App\Models\Relacion;
use Livewire\Attributes\Rule;
use Livewire\Form;

class RelacionForm extends Form
{
    public ?Relacion $relacion;

    #[Rule('required')]
    public $gerencia_id;

    #[Rule('nullable')]
    public $subgerencia_id;

    #[Rule('nullable')]
    public $departamento_id;

    #[Rule('nullable')]
    public $unidad_id;

    #[Rule('nullable')]
    public $area_id;

    public function setPost(Relacion $relacion)
    {
        $this->relacion = $relacion;
        $this->gerencia_id = $relacion->gerencia_id;
        $this->subgerencia_id = $relacion->subgerencia_id;
        $this->departamento_id = $relacion->departamento_id;
        $this->unidad_id = $relacion->unidad_id;
        $this->area_id = $relacion->area_id;
    }

    public function resetPost()
    {
        $this->reset();
    }
}
