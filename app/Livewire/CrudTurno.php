<?php

namespace App\Livewire;

use App\Livewire\Forms\TurnoForm;
use App\Models\Turno;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudTurno extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $search;

    public TurnoForm $form;

    public function render()
    {
        $turnos = Turno::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.turno.crud-turno', compact('turnos'));
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
        if (!isset($this->form->turno->id)) {
            Turno::create($this->form->all());
        } else {
            $turno = Turno::find($this->form->turno->id);
            $turno->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Turno $turno)
    {
        $this->form->setPost($turno);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Turno $turno)
    {
        $turno->delete();
    }
}
