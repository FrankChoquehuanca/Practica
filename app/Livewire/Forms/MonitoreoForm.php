<?php

namespace App\Livewire\Forms;

use App\Models\Image;
use App\Models\Monitoreo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MonitoreoForm extends Form
{
    public ?Monitoreo $monitoreo;

    #[Rule('required|min:3')]
    public $horaingreso,$horasalida,$horacsalida,$fecha,$horacingreso;
    #[Rule('required')]
    public $asignacion_id;
    #[Rule('required')]
    public $turno_id;
    #[Validate(['images.*' => 'nullable|mimes:png,jpg,jpeg,csv,xlsx,pdf,docx,txt|max:50000'])]
    public $images = [];

    public function setPost(Monitoreo $monitoreo, ?Image $image = null)
    {
        $this->monitoreo = $monitoreo;
        $this->horaingreso = $monitoreo->horaingreso;
        $this->horasalida = $monitoreo->horasalida;
        $this->horacsalida = $monitoreo->horacsalida;
        $this->fecha = $monitoreo->fecha;
        $this->horacingreso = $monitoreo->horacingreso;
        $this->asignacion_id = $monitoreo->asignacion_id;
        $this->turno_id = $monitoreo->turno_id;
        $this->images = $image ? [$image] : []; // Establece la imagen si se proporciona, de lo contrario, se mantendrá como null
    }
    public function resetPost()
    {
        $this->reset();
    }
}
