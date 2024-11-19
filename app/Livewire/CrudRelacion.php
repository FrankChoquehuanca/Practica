<?php

namespace App\Livewire;

use App\Livewire\Forms\RelacionForm;
use App\Models\Area;
use App\Models\Departamento;
use App\Models\Gerencia;
use App\Models\Relacion;
use App\Models\Subgerencia;
use App\Models\Unidad;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudRelacion extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $search;

    public RelacionForm $form;

    public function render()
    {
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();
        $departamentos = Departamento::all();
        $unidades = Unidad::all();
        $areas = Area::all();
        $relaciones = Relacion::latest('id')->paginate(6);
        return view('livewire.relacion.crud-relacion', compact('relaciones', 'departamentos', 'unidades', 'areas', 'subgerencias', 'gerencias'));
    }

    public function create(){
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }

    public function store(){
        $this->validate([
            'form.gerencia_id' => 'required',
            // Establece los otros campos como opcionales
            'form.subgerencia_id' => 'nullable',
            'form.departamento_id' => 'nullable',
            'form.unidad_id' => 'nullable',
            'form.area_id' => 'nullable',
        ]);

        if (!isset($this->form->relacion->id)) {
            // Crea una nueva relación solo con los campos requeridos
            Relacion::create([
                'gerencia_id' => $this->form->gerencia_id,
                'subgerencia_id' => $this->form->subgerencia_id,
                'departamento_id' => $this->form->departamento_id,
                'unidad_id' => $this->form->unidad_id,
                'area_id' => $this->form->area_id,
            ]);
        } else {
            // Actualiza la relación con todos los campos, incluyendo los opcionales
            $relacion = Relacion::find($this->form->relacion->id);
            $relacion->update($this->form->all());
        }

        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Relacion $relacion)
    {
        $this->form->setPost($relacion);
        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Relacion $relacion)
    {
        $relacion->delete();
    }
}
