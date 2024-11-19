<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartamentoForm;
use App\Models\Departamento;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CrudDepartamento extends Component
{

    use WithPagination;
    public $isOpen = false;
    public $search;

    public DepartamentoForm $form;

    public function render()
    {
        $departamentos = Departamento::where('nombre', 'like', '%' . $this->search . '%')->latest('id')->paginate(6);
        return view('livewire.departamento.crud-departamento', compact('departamentos'));
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
        if (!isset($this->form->departamento->id)) {
            Departamento::create($this->form->all());
        } else {
            $departamento = Departamento::find($this->form->departamento->id);
            $departamento->update($this->form->all());
        }
        $this->reset(['isOpen']);
        $this->dispatch('alert', 'Registro creado satisfactoriamente');
        $this->dispatch('sweetalert', message: 'Registro creado satisfactoriamente');
    }

    public function edit(Departamento $departamento)
    {
        $this->form->setPost($departamento);

        $this->isOpen = true;
    }

    #[On('delItem')]
    public function delete(Departamento $departamento)
    {
        $departamento->delete();
    }
}
