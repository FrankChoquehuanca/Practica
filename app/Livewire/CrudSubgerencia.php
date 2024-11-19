<?php

namespace App\Livewire;

use App\Livewire\Forms\SubgerenciaForm;
use App\Models\Subgerencia;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudSubgerencia extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public SubgerenciaForm $form;

    public function render()
    {
        $subgerencias = Subgerencia::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.subgerencia.crud-subgerencia', compact('subgerencias'));
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
        if (!isset($this->form->subgerencia->id)) {
            Subgerencia::create($this->form->all());
        } else {
            $subgerencia = Subgerencia::find($this->form->subgerencia->id);
            $subgerencia->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Subgerencia $subgerencia)
    {
        $this->form->setPost($subgerencia);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Subgerencia $subgerencia)
    {
        $subgerencia->delete();
    }
}
