<?php

namespace App\Livewire;

use App\Livewire\Forms\UnidadForm;
use App\Models\Unidad;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudUnidad extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public UnidadForm $form;

    public function render()
    {
        $unidades = Unidad::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.unidad.crud-unidad', compact('unidades'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->form->resetPost();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        if (!isset($this->form->unidad->id)) {
            Unidad::create($this->form->all());
        } else {
            $unidad = Unidad::find($this->form->unidad->id);
            $unidad->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Unidad $unidad)
    {
        $this->form->setPost($unidad);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Unidad $unidad)
    {
        $unidad->delete();
    }
}
