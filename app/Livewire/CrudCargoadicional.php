<?php

namespace App\Livewire;

use App\Livewire\Forms\CargoadicionalForm;
use App\Models\Cargoadicional;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudCargoadicional extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public CargoadicionalForm $form;

    public function render()
    {
        $cargoadicionales = Cargoadicional::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.cargoadicional.crud-cargoadicional', compact('cargoadicionales'));
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
        if (!isset($this->form->cargoadicional->id)) {
            Cargoadicional::create($this->form->all());
        } else {
            $cargoadicional = Cargoadicional::find($this->form->cargoadicional->id);
            $cargoadicional->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Cargoadicional $cargoadicional)
    {
        $this->form->setPost($cargoadicional);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Cargoadicional $cargoadicional)
    {
        $cargoadicional->delete();
    }
}
