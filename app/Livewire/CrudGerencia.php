<?php

namespace App\Livewire;

use App\Livewire\Forms\GerenciaForm;
use App\Models\Gerencia;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudGerencia extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public GerenciaForm $form;

    public function render()
    {
        $gerencias = Gerencia::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.gerencia.crud-gerencia', compact('gerencias'));
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
        if (!isset($this->form->gerencia->id)) {
            Gerencia::create($this->form->all());
        } else {
            $gerencia = Gerencia::find($this->form->gerencia->id);
            $gerencia->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Gerencia $gerencia)
    {
        $this->form->setPost($gerencia);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Gerencia $gerencia)
    {
        $gerencia->delete();
    }
}
